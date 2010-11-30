<?php
/*
 * Web page navigation links
 * For handling if the current item should have class='active'
 * and for determining the last item
 */

class Navigation
{
  public
    $name,
    $route,
    $last;

  public function __construct($name, $route, $last = false)
  {
    $this->name = $name;
    $this->route = $route;
    $this->last = $last;

    // so we can use url_for
    sfLoader::loadHelpers(array('Url', 'Tag'));
  }

  // to return a string of class(es)
  // for use in the following case
  // class="<?php $navigation->getClass()"
  public function getClass()
  {
    $logger = sfContext::getInstance()->getLogger();
    $classes = array();
    if ($this->isLast())
    {
      $classes[] = 'last';
    }

    // add class="active", if we are on this page/section
    $url_name = url_for($this->route);
    // remove last s, if it exists for nice routes
    if ($url_name[strlen($url_name) - 1] == 's')
    {
      $url_name = substr($url_name, 0, -1);
    }

    $url_name = preg_replace('/^\/[A-Z_]+\.php/i', '', $url_name); // strip out /frontend_dev.php
    #$logger->debug("url name: ".$url_name);
    $url_name = str_replace('/', '\/', $url_name); // escape '/' characters before regex
    #$logger->debug("url name escaped: ".$url_name);

    $request_uri = preg_replace('/^\/[A-Z_]+\.php/i', '', $_SERVER['REQUEST_URI']); // strip out /frontend_dev.php
    #$logger->debug("path: ".$request_uri);

    // first check for homepage condition, because it = /, and all pages start with /
    if (!($url_name == '\/' && $request_uri != '/') // if not homepage
      && preg_match('/^'.$url_name.'/', $request_uri))
    {
      $classes[] = 'active';
    }

    return implode(' ', $classes);
  }

  public function isLast()
  {
    return $this->last;
  }
}
