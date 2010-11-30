<?php
$request = sfContext::getInstance()->getRequest();

// get around problem when run from commandline 
$url = 'http://localhost/';
if ($request instanceof sfWebRequest)
{
  $url = 'http'.($request->isSecure() ? 's' : '').'://'.$request->getHost(). '/';
}

if (!sfConfig::get('sf_tcpdf_dir'))
{
  sfConfig::set('sf_tcpdf_dir', SF_ROOT_DIR. DIRECTORY_SEPARATOR. 'plugins'. DIRECTORY_SEPARATOR. 'sfTCPDFPlugin'. DIRECTORY_SEPARATOR. 'lib'. DIRECTORY_SEPARATOR. 'tcpdf'. DIRECTORY_SEPARATOR);
}
sfConfig::set('sf_tcpdf_font_dir', sfConfig::get('sf_tcpdf_dir'). 'fonts'. DIRECTORY_SEPARATOR);



// PLEASE SET THE FOLLOWING CONSTANTS:

    /**
     * installation path
     */
    define ("K_PATH_MAIN", sfConfig::get('sf_tcpdf_dir'));

    /**
     * url path
     */
    define ("K_PATH_URL", $url);

    /**
     * path for PDF fonts
     */
    define ("K_PATH_FONTS", K_PATH_MAIN. "fonts/");

    /**
     * cache directory for temporary files (full path)
     */
    define ("K_PATH_CACHE", K_PATH_MAIN."cache/");

    /**
     * cache directory for temporary files (url path)
     */
    define ("K_PATH_URL_CACHE", K_PATH_URL."cache/");

    /**
     *images directory
     */
    define ("K_PATH_IMAGES", sfConfig::get('sf_web_dir')."/images/");

    /**
     * blank image
     */
    define ("K_BLANK_IMAGE", sfConfig::get('sf_web_dir')."/sfTCPDFPlugin/images/_blank.png");

if (defined('K_TCPDF_EXTERNAL_CONFIG')) return;

define('K_TCPDF_EXTERNAL_CONFIG', true);

    /**
     * page format
     */
    define ("PDF_PAGE_FORMAT", "A4");

    /**
     * page orientation (P=portrait, L=landscape)
     */
    define ("PDF_PAGE_ORIENTATION", "P");

    /**
     * document creator
     */
    define ("PDF_CREATOR", "TCPDF");

    /**
     * document author
     */
    define ("PDF_AUTHOR", "pdf author");

    /**
     * header title
     */
    define ("PDF_HEADER_TITLE", "sfTCPDFPlugin");

    /**
     * header description string
     */
    define ("PDF_HEADER_STRING", "TCPDF\nPlugin\nFor Symfony");

    /**
     * image logo
     */
    define ("PDF_HEADER_LOGO", "../sfTCPDFPlugin/images/logo_example.png");

    /**
     * header logo image width [mm]
     */
    define ("PDF_HEADER_LOGO_WIDTH", 20);

    /**
     *  document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch]
     */
    define ("PDF_UNIT", "mm");

    /**
     * header margin
     */
    define ("PDF_MARGIN_HEADER", 5);

    /**
     * footer margin
     */
    define ("PDF_MARGIN_FOOTER", 10);

    /**
     * top margin
     */
    define ("PDF_MARGIN_TOP", 27);

    /**
     * bottom margin
     */
    define ("PDF_MARGIN_BOTTOM", 25);

    /**
     * left margin
     */
    define ("PDF_MARGIN_LEFT", 15);

    /**
     * right margin
     */
    define ("PDF_MARGIN_RIGHT", 15);

    /**
     * main font name
     */
    define ("PDF_FONT_NAME_MAIN", "FreeSerif"); //vera

    /**
     * main font size
     */
    define ("PDF_FONT_SIZE_MAIN", 10);

    /**
     * data font name
     */
    define ("PDF_FONT_NAME_DATA", "FreeSerif"); //verase

    /**
     * data font size
     */
    define ("PDF_FONT_SIZE_DATA", 8);

    /**
     *  scale factor for images (number of points in user unit)
     */
    define ("PDF_IMAGE_SCALE_RATIO", 4);

    /**
     * magnification factor for titles
     */
    define("HEAD_MAGNIFICATION", 1.1);

    /**
     * height of cell repect font height
     */
    define("K_CELL_HEIGHT_RATIO", 1.25);

    /**
     * title magnification respect main font size
     */
    define("K_TITLE_MAGNIFICATION", 1.3);

    /**
     * reduction factor for small font
     */
    define("K_SMALL_RATIO", 2/3);

