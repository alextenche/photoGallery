<!DOCTYPE html>
<html>

<head>
  <meta name="author" content="Alexandru Tenche">
  <title>photoGallery - admin</title>
  <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../public/css/main.css">
  <style type="text/css">

    @media all and (max-width: 1200px) { /* screen size until 1200px */
      body {
        font-size: 1.6em; /* 1.5x default size */
      }
    }
    @media all and (max-width: 1000px) { /* screen size until 1000px */
      body {
        font-size: 1.3em; /* 1.2x default size */
      }
    }
    @media all and (max-width: 500px) { /* screen size until 500px */
      body {
        font-size: 0.9em; /* 0.8x default size */
      }
    }

    .thumb {
      margin-bottom: 30px;
    }
    .img-responsive{
      max-height: 200px;
      min-height: 200px;
    }
    .thumbnail.with-caption {
      display: inline-block;
      background: #f5f5f5;
    }
    .thumbnail.with-caption p {
      margin: 0;
      padding-top: 0.5em;
    }
    .thumbnail.with-caption small:before {
      content: '\2014 \00A0';
    }
    .thumbnail.with-caption small {
      width: 100%;
      text-align: right;
      display: inline-block;
      color: #999;
    }
    .main {}
    footer{
      background-color: #178acc;
      height: 250px;
    }
  </style>
</head>

<body>
  <div class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">

        <a href="/photoGallery/public/index.php" class="navbar-brand"> photoGallery - adminArea </a>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      </div>

      <div class="collapse navbar-collapse">
        <!--<ul class="nav navbar-nav">
          <li class="active"><a href="#div1">Home</a></li>
          <li><a href="#div2">About</a></li>
          <li><a href="#div3">Download</a></li>
        </ul>-->

        
      </div>

    </div>
  </div><!-- navbar -->