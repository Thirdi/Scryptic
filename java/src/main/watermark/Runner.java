package watermark;

import java.awt.Color;
import java.util.ArrayList;
import java.util.List;

/**
 * Driver for Watermarker
 */
public class Runner {
    
    public static void main(String[] args) {
        try {
            testSingle(); 
            testLimit(); 
            testMulti();
            testPreview();
        } catch (Exception e) {
            e.printStackTrace(System.out);
        }
    }
    
    private static void testPreview() throws WatermarkException {
        Configuration cfg = getConfiguration();
        Parameter param = getParameter(0);
        List<Parameter> params = new ArrayList<Parameter>(1);
        params.add(param);
        String source = "movie-script.pdf";
        String output = "preview.png";
        Watermarker wm = new Watermarker();
        wm.preview(source, output, cfg, params);
    }
    
    private static void testSingle() throws WatermarkException {
        Configuration cfg = getConfiguration();
        Parameter param = getParameter(0);
        String source = "movie-script.pdf";
        String output = "watermark-single-output.pdf";
        Watermarker wm = new Watermarker();
        Statistics stat = wm.create(source, output, cfg, param);
        System.out.println(stat);
    }

    private static void testLimit() throws WatermarkException {
        Configuration cfg = getConfiguration();
        Parameter param = getParameter(0);
        List<Parameter> params = new ArrayList<Parameter>(1);
        params.add(param);
        String source = "movie-script.pdf";
        String output = "watermark-limit-output.pdf";
        Watermarker wm = new Watermarker();
        Statistics stat = wm.create(source, output, cfg, params, 5);
        System.out.println(stat);
    }

    private static void testMulti() throws WatermarkException {
        int numParams = 10;
        List<Parameter> params = new ArrayList<Parameter>(numParams);
        for (int i = 0; i < numParams; i++) {
            params.add(getParameter(i));
        }
        Configuration cfg = getConfiguration();
        String source = "movie-script.pdf";
        String output = "moviescript-multi-output.pdf";
        Watermarker wm = new Watermarker();
        wm.create(source, output, cfg, params);
    }
    
    private static Configuration getConfiguration() {
        Configuration cfg = new Configuration();
        cfg.setFontSize(30);
        cfg.setFontColour(new Color(255, 0, 0));
        cfg.setOpacity(0.5F);
        return cfg;
    }

    private static Parameter getParameter(int idx) {
        Parameter param = new Parameter();
        param.setLeftText("left text - " + idx);
        param.setRightText("right text - " + idx);
        param.setTopText("top text - " + idx);
        param.setBottomText("bottom text - " + idx);
        param.setDiagonalText("diagonal text - " + idx);
        param.setDiagonalTextRotation(45F);
        return param;
    }
}
