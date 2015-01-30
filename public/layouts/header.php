<!doctype html>
<html> 
<head>
  <meta name="author" content="Tenche Alexandru">
  <title>photoGallery</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
  <style type="text/css">
    .main{
      
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




html,
body {
  height: 100%;
  /* The html and body elements cannot have any padding or margin. */
}

/* Wrapper for page content to push down footer */
.main {

  min-height: 100%;
  height: auto;
  /* Negative indent footer by its height */
  margin-top: 40px;
  margin: 20px auto -60px;
  /* Pad bottom by footer height */
  padding: 0 0 60px;
  margin-top: 40px;
}

/* Set the fixed height of the footer here */
#footer {
  /*height: 60px;*/
  background-color: #ccc;
}

  </style>
</head>

<body>
  <div class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">

        <a href="#" class="navbar-brand">alexTenche</a>

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

        <form class="navbar-form navbar-right">
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-success">Log In</button>
        </form>
      </div>

    </div>
  </div><!-- navbar -->

  <div class="container main">