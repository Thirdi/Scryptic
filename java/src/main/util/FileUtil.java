package util;

public class FileUtil {
    public static boolean chmod(String filename, String permission) {
        boolean result = false;
        try {
            Process proc = Runtime.getRuntime().exec("chmod " + permission + " " + filename);
            result = true;
        } catch (Exception e) {
            e.printStackTrace();
        }
        return result;
    }
}
