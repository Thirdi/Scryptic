package watermark;

import java.awt.Color;

import com.lowagie.text.pdf.BaseFont;

public class Configuration {

    private int fontSize;
    private String font;
    private String fontFilename;
    private Color fontColour;
    private float opacity;
    
    public Configuration() {
        // set default values ...
        this.font = BaseFont.HELVETICA;
        this.fontFilename = null;
        this.fontSize = 18;
        this.fontColour = new Color(255, 255, 255);
        this.opacity = 1.0F;
    }

    public int getFontSize() {
        return fontSize;
    }

    public void setFontSize(int fontSize) {
        this.fontSize = fontSize;
    }

    public String getFont() {
        return font;
    }

    public void setFont(String font) {
        this.font = font;
    }

    public String getFontFilename() {
        return fontFilename;
    }

    public void setFontFilename(String fontFilename) {
        this.fontFilename = fontFilename;
    }

    public Color getFontColour() {
        return fontColour;
    }

    public void setFontColour(Color fontColour) {
        this.fontColour = fontColour;
    }
    
    public float getOpacity() {
        return opacity;
    }

    public void setOpacity(float opacity) {
        this.opacity = opacity;
    }

    public String toString() {
        StringBuffer sb = new StringBuffer();
        sb.append("font=").append(this.font).append(", ");
        sb.append("fontFilename=").append(this.fontFilename).append(", ");
        sb.append("fontSize=").append(this.fontSize).append(", ");
        sb.append("fontColour=").append(this.fontColour).append(", ");
        sb.append("opacity=").append(this.opacity).append(", ");
        return sb.toString();
    }

}
