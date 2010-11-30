package converter;

import java.io.File;
import java.net.ConnectException;

import com.artofsolving.jodconverter.openoffice.connection.OpenOfficeConnection;
import com.artofsolving.jodconverter.openoffice.connection.SocketOpenOfficeConnection;
import com.artofsolving.jodconverter.openoffice.converter.OpenOfficeDocumentConverter;

public class DocumentConverter {

    private int port = 8100;
    
    public void setPort(int port) {
        this.port = port;
    }
    
    /**
     * See http://www.artofsolving.com/node/16
     * 
     * Converts a document from one format to another. Extension is important
     * since it determines the conversion. 
     * 
     * Precond: OpenOffice must be running as a service. See http://www.artofsolving.com/node/10
     * 
     * @param sourceName
     * @param targetName
     * @throws ConnectException 
     */
    public void convert(String sourceName, String targetName) throws ConnectException {
        File inputFile = new File(sourceName);
        File outputFile = new File(targetName);

        // connect to an OpenOffice.org instance running on port 8100
        OpenOfficeConnection connection = new SocketOpenOfficeConnection(this.port);
        connection.connect();

        // convert
        OpenOfficeDocumentConverter converter = new OpenOfficeDocumentConverter(connection);
        converter.convert(inputFile, outputFile);

        // close the connection
        connection.disconnect();
    }
}
