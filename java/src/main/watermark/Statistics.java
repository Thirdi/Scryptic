package watermark;

public class Statistics {

    private static final long serialVersionUID = 1L;
    
    private int numPageWatermarked;
    private int numDocuments;
    private long executionTime;
    private long finalFileSize;
    
    public int getNumPageWatermarked() {
        return numPageWatermarked;
    }
    
    public void setNumPageWatermarked(int numPageWatermarked) {
        this.numPageWatermarked = numPageWatermarked;
    }
    
    public long getExecutionTime() {
        return executionTime;
    }
    
    public void setExecutionTime(long executionTime) {
        this.executionTime = executionTime;
    }

    public long getFinalFileSize() {
        return finalFileSize;
    }

    public void setFinalFileSize(long finalFileSize) {
        this.finalFileSize = finalFileSize;
    }

    public void setNumDocuments(int v) {
        this.numDocuments = v;
    }
    
    public int getNumDocuments() {
        return this.numDocuments;
    }
    
    public String toString() {
        StringBuffer sb = new StringBuffer();
        sb.append("numPageWatermarked=").append(this.numPageWatermarked);
        sb.append("numDocuments=").append(this.numDocuments);
        sb.append(", finalFileSize=").append(this.finalFileSize).append("-bytes");
        sb.append(", executionTime=").append(this.executionTime).append("-ms");
        return sb.toString();
    }
}
