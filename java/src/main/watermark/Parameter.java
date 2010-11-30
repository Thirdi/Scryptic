package watermark;

public class Parameter {

    private String leftText;
    private String rightText;
    private String topText;
    private String bottomText;
    private String centerImageName;
    private int centerImageWidth;
    private int centerImageHeight;
    private String diagonalText;
    private float diagonalTextRotation;

    public String getLeftText() {
        return leftText;
    }

    public void setLeftText(String leftText) {
        this.leftText = leftText;
    }

    public String getRightText() {
        return rightText;
    }

    public void setRightText(String rightText) {
        this.rightText = rightText;
    }

    public String getTopText() {
        return topText;
    }

    public void setTopText(String topText) {
        this.topText = topText;
    }

    public String getBottomText() {
        return bottomText;
    }

    public void setBottomText(String bottomText) {
        this.bottomText = bottomText;
    }

    public String getCenterImageName() {
        return centerImageName;
    }

    public void setCenterImageName(String centerImageName) {
        this.centerImageName = centerImageName;
    }

    public String getDiagonalText() {
        return diagonalText;
    }

    public void setDiagonalText(String diagonalText) {
        this.diagonalText = diagonalText;
    }

    public float getDiagonalTextRotation() {
        return diagonalTextRotation;
    }

    public void setDiagonalTextRotation(float diagonalTextRotation) {
        this.diagonalTextRotation = diagonalTextRotation;
    }

    public int getCenterImageWidth() {
        return centerImageWidth;
    }

    public void setCenterImageWidth(int centerImageWidth) {
        this.centerImageWidth = centerImageWidth;
    }

    public int getCenterImageHeight() {
        return centerImageHeight;
    }

    public void setCenterImageHeight(int centerImageHeight) {
        this.centerImageHeight = centerImageHeight;
    }

    public String toString() {
        StringBuffer sb = new StringBuffer();
        sb.append("topText=").append(this.topText).append(", ");
        sb.append("bottomText=").append(this.bottomText).append(", ");
        sb.append("leftText=").append(this.leftText).append(", ");
        sb.append("rightText=").append(this.rightText).append(", ");
        sb.append("centerImageName=").append(this.centerImageName);
        sb.append("centerImageWidth=").append(this.centerImageWidth);
        sb.append("centerImageHeight=").append(this.centerImageHeight);
        return sb.toString();
    }
}
