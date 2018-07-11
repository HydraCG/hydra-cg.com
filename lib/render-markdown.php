<?php

$filePath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $_SERVER['PATH_INFO']);
$rootPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '../..');

// Only process Markdown files within the Hydra folder
if (substr($filePath, 0, strlen($rootPath)) === $rootPath
    && pathinfo($filePath, PATHINFO_EXTENSION) === 'md') {
  require_once(__DIR__ . DIRECTORY_SEPARATOR . 'Parsedown.php');
  $content = Parsedown::instance()->text(file_get_contents($filePath));
} else {
  $content = '<h1>File not found</h1>';
  $content .= '<p>The requested file could not be found.</p>';
}

$header = (substr($content, 0, 2) === '<h' && preg_match('/<h\d>([^<]+)</', $content, $matches) === 1)
  ? $matches[1] . ' | '
  : '';


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $header ?>Hydra W3C Community Group</title>
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site:id" content="1524709850">
  <meta name="twitter:creator:id" content="64360611">
  <meta name="twitter:description" content="Hydra simplifies the development of interoperable, hypermedia-driven Web APIs">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Exo:400,700">
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
  <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css">
  <![endif]-->
  <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
  <!--<![endif]-->
  <link rel="stylesheet" href="/css/styles.css">
  <!--<![endif]-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.9.0/themes/prism-okaidia.min.css">
</head>
<body>
  <div class="header">
      <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
          <span class="pure-menu-heading"><img src="/img/logo.svg" alt="Hydra"></span>
          <ul>
              <li><a href="/#specifications">Specifications</a></li>
              <li><a href="/#community">Community</a></li>
              <li><a href="/#tooling">Tooling</a></li>
              <li><a href="/minutes/">Minutes</a></li>
          </ul>
      </div>
  </div>

  <div class="content" style="min-height: calc(100vh - 9.45em)">
      <div class="pure-g">
          <div class="l-box pure-u-1">
<?php
echo $content;
?>
          </div>
      </div>
  </div>

  <div class="footer l-box is-center">
      &copy; 2012–2018, Hydra W3C Community Group
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.9.0/prism.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.9.0/components/prism-json.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.9.0/components/prism-http.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.9.0/components/prism-javascript.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.9.0/components/prism-typescript.min.js"></script>
</body>
</html>
