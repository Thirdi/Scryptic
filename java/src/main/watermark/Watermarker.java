package watermark;

import java.awt.Image;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.RandomAccessFile;
import java.nio.ByteBuffer;
import java.nio.channels.FileChannel;
import java.util.ArrayList;
import java.util.List;

import javax.imageio.ImageIO;

import com.lowagie.text.Document;
import com.lowagie.text.DocumentException;
import com.lowagie.text.Element;
import com.lowagie.text.Rectangle;
import com.lowagie.text.pdf.BaseFont;
import com.lowagie.text.pdf.PdfContentByte;
import com.lowagie.text.pdf.PdfCopy;
import com.lowagie.text.pdf.PdfGState;
import com.lowagie.text.pdf.PdfImportedPage;
import com.lowagie.text.pdf.PdfReader;
import com.lowagie.text.pdf.PdfStamper;
import com.sun.pdfview.PDFFile;
import com.sun.pdfview.PDFPage;

public class Watermarker {

    /**
     * Adapted from:
     * http://itextdocs.lowagie.com/tutorial/general/copystamp/index.php
     */
    public Statistics create(String sourceFilename, String outputFilename,
            Configuration cfg, Parameter param) throws WatermarkException {
        List<Parameter> params = new ArrayList<Parameter>(1);
        params.add(param);
        return this.create(sourceFilename, outputFilename, cfg, params);
    }

    public Statistics create(String sourceFilename, String outputFilename,
            Configuration cfg, List<Parameter> params) throws WatermarkException {
        return this.create(sourceFilename, outputFilename, cfg, params, -1);
    }

    /**
     * 
     * @param sourceFilename input PDF filename
     * @param outputFilename output PDF filename
     * @param cfg Print configuration
     * @param params Print parameters
     * @param limit Number of pages to watermark. Negative value implies no limit.
     * @return Statistics object
     * 
     * @throws WatermarkException
     */
    public Statistics create(String sourceFilename, String outputFilename,
            Configuration cfg, List<Parameter> params, int limit) throws WatermarkException {
    
        final Statistics statistics = new Statistics();
        final long start = System.currentTimeMillis();
        List<String> tmpNames = new ArrayList<String>();        
        try {
            // create one pdf for each parameter
            tmpNames = batchCreate(sourceFilename, cfg, params);

            // concat PDFs
            concatPdfs(outputFilename, tmpNames, limit, statistics);

            // set file size
            statistics.setFinalFileSize(this.getFileSize(outputFilename));
        } catch (Exception de) {
            throw new WatermarkException("Error watermarking PDF: " + de.getMessage());
        } finally {
            cleanup(tmpNames);
            statistics.setExecutionTime(System.currentTimeMillis() - start);
        }
        return statistics;
    }

    public void preview(String source, String output, Configuration cfg,
            List<Parameter> params) throws WatermarkException {

        final String tmpDir = (System.getenv("TMPDIR") == null) ? "/tmp" : System.getenv("TMPDIR");
        final String tmpFilename = tmpDir
                + System.getProperty("file.separator")
                + System.currentTimeMillis() + ".pdf";

        Watermarker wm = new Watermarker();
        try {
            // watermark sample pdf
            wm.create(source, tmpFilename, cfg, params, 1);

            // create an image. reference: https://pdf-renderer.dev.java.net/examples.html
            this.createPdfImage(tmpFilename, output);
        } catch (Exception e) {
            throw new WatermarkException(e.getMessage());
        } finally {
            File f = new File(tmpFilename);
            if (f.exists()) {
                f.delete();
            }
        }
    }

    private void createPdfImage(String sourceFilename, String outputFilename)
            throws IOException {
        // load a pdf from a byte buffer
        File file = new File(sourceFilename);
        RandomAccessFile raf = new RandomAccessFile(file, "r");
        FileChannel channel = raf.getChannel();
        ByteBuffer buf = channel.map(FileChannel.MapMode.READ_ONLY, 0, channel.size());
        PDFFile pdffile = new PDFFile(buf);

        // draw the first page to an image
        PDFPage page = pdffile.getPage(0);

        // get the width and height for the doc at the default zoom
        java.awt.Rectangle rect = new java.awt.Rectangle(0, 0, (int) page.getBBox().getWidth(), (int) page.getBBox().getHeight());

        boolean fillbackground = true;
        boolean blockuntildone = true;
        // generate the image
        Image img = page.getImage(rect.width, rect.height, // width & height
                rect, // clip rect
                null, // null for the ImageObserver
                fillbackground, // fill background with white
                blockuntildone // block until drawing is done
                );
        BufferedImage bi = (BufferedImage) img;
        File output = new File(outputFilename);
        ImageIO.write(bi, "png", output);
    }
    
    private long getFileSize(String fname) {
        long size = -1;
        try {
            File f = new File(fname);
            size = f.length();
        } catch (Exception e) {
            // ignore
        }
        return size;
    }

    private void cleanup(List<String> tmpNames) {
        for (String fname : tmpNames) {
            File f = new File(fname);
            f.delete();
        }
    }

    /**
     * Adapted from
     * http://itextdocs.lowagie.com/tutorial/general/copystamp/index.php
     */
    private void concatPdfs(String outputFilename, List<String> tmpNames, int limit, Statistics statistics)
            throws DocumentException, IOException {

        int numPages = 0;
        int numDocs = 0;
        Document document = null;
        PdfCopy copy = null;
        
        try {
            for (String tmpName : tmpNames) {
                PdfReader reader = new PdfReader(tmpName);
                if (document == null) {
                    document = new Document(reader.getPageSizeWithRotation(1));
                    copy = new PdfCopy(document, new FileOutputStream(
                            outputFilename));
                    document.open();
                }
                numDocs++;

                int n = reader.getNumberOfPages();
                for (int i = 1; i <= n; i++) {
                    PdfImportedPage page = copy.getImportedPage(reader, i);
                    copy.addPage(page);
                    numPages++;
                    if (limit > 0 && numPages == limit) {
                        throw new WatermarkLimitException();
                    }
                }
            }
            
        } catch (WatermarkLimitException e) {
            // limit reached
        } finally {
            if (document != null) {
                document.close();
            }
        }
        
        statistics.setNumPageWatermarked(numPages);
        statistics.setNumDocuments(numDocs);
    }

    private List<String> batchCreate(String sourceFilename, Configuration cfg,
            List<Parameter> params) throws IOException, DocumentException {

        final List<String> fnames = new ArrayList<String>(params.size());

        // we create a reader for a certain document
        final String tmpDir = (System.getenv("TMPDIR") == null) ? "/tmp" : System.getenv("TMPDIR");
        final String baseFname = tmpDir + System.getProperty("file.separator") + (int)(Math.random() * 1000) + "_" + System.currentTimeMillis() + "-";

        com.lowagie.text.Image watermarkImage = null;
        for (Parameter param : params) {

            String tmpName = baseFname + fnames.size() + ".pdf";
            fnames.add(tmpName);

            final PdfReader reader = new PdfReader(sourceFilename);
            final Rectangle pageSize = reader.getPageSize(1);
            final PdfStamper stamp = new PdfStamper(reader,
                    new FileOutputStream(tmpName));
            this.addMeta(stamp); // optional step

            // adding content to each page
            PdfContentByte over;
            PdfContentByte under;
            BaseFont bf = BaseFont.createFont(cfg.getFontFilename(),
                    BaseFont.WINANSI, BaseFont.EMBEDDED);
            
            if (param.getCenterImageName() != null && param.getCenterImageName().length() > 0 && watermarkImage == null) {
                watermarkImage = com.lowagie.text.Image.getInstance(param.getCenterImageName());
                final int xPos = (int) (pageSize.getWidth() / 2) - (param.getCenterImageWidth() / 2);
                final int yPos = (int) (pageSize.getHeight() / 2) - (param.getCenterImageHeight() / 2);
                watermarkImage.setAbsolutePosition(xPos, yPos);
            }
            
            // for transparency: http://itextdocs.lowagie.com/tutorial/directcontent/colors/index.php
            final PdfGState gs = new PdfGState();
            gs.setBlendMode(PdfGState.BM_SOFTLIGHT);
            gs.setFillOpacity(cfg.getOpacity());

            final int n = reader.getNumberOfPages();
            int i = 0;
            while (i < n) {
                i++;
                over = stamp.getOverContent(i);
                over.setColorFill(cfg.getFontColour());
                over.setGState(gs);
                this.addWatermarks(over, cfg, param, bf, pageSize);
                
                if (watermarkImage != null) {
                    under = stamp.getUnderContent(i);
                    under.saveState();
                    final PdfGState gs2 = new PdfGState();
                    gs2.setFillOpacity(cfg.getOpacity());
                    gs2.setStrokeOpacity(cfg.getOpacity());
                    under.setGState(gs2);
                    under.addImage(watermarkImage);
                    under.restoreState();
                }
            }

            watermarkImage = null;
            stamp.close();
        }

        return fnames;
    }

    private void addWatermarks(PdfContentByte over, Configuration cfg,
            Parameter param, BaseFont bf, Rectangle pageSize) {

        final float width = pageSize.getWidth();
        final float height = pageSize.getHeight();
        final int vertMargin = 30;
        final int horiMargin = 30;

        over.beginText();
        over.setFontAndSize(bf, cfg.getFontSize());

        float x = width / 2;
        if (param.getTopText() != null && !param.getTopText().equals("")) {
            over.showTextAligned(Element.ALIGN_CENTER, param.getTopText(), x,
                    height - ( Math.max(vertMargin, cfg.getFontSize())), 0);
        }
        if (param.getBottomText() != null && !param.getBottomText().equals("")) {
            over.showTextAligned(Element.ALIGN_CENTER, param.getBottomText(),
                    x, vertMargin, 0);
        }

        float y = height / 2;
        if (param.getLeftText() != null && !param.getLeftText().equals("")) {
            over.showTextAligned(Element.ALIGN_CENTER, param.getLeftText(),
                    Math.max(horiMargin, cfg.getFontSize()), y, 90);
        }
        if (param.getRightText() != null && !param.getRightText().equals("")) {
            over.showTextAligned(Element.ALIGN_CENTER, param.getRightText(),
                    width - horiMargin, y, 90);
        }

        if (param.getDiagonalText() != null
                && !param.getDiagonalText().equals("")) {
            over.showTextAligned(Element.ALIGN_CENTER, param.getDiagonalText(),
                    x, y, param.getDiagonalTextRotation());
        }
        over.endText();
    }

    private void addMeta(PdfStamper stamper) {
        // HashMap moreInfo = new HashMap();
        // moreInfo.put("Author", "Bruno Lowagie");
        // stamp.setMoreInfo(moreInfo);
    }
}
