<!DOCTYPE html>
<html lang="en" class="html">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0,shrink-to-fit=no">
  <meta name="user" content="{{ Auth::user() }}">
  <link rel="stylesheet" href="/assets/fonts/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="/assets/fonts/iconsmind-s/css/iconsminds.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <title>Salut</title>
  <style>
    .loading {
      display: inline-block;
      width: 30px;
      height: 30px;
      border: 2px solid rgba(0, 0, 0, .2);
      border-radius: 50%;
      border-top-color: rgba(0, 0, 0, .4);
      animation: spin 1s ease-in-out infinite;
      -webkit-animation: spin 1s ease-in-out infinite;
      left: calc(50%);
      top: calc(50%);
      position: fixed;
      z-index: 1;
    }

    .body {
      padding-bottom: 0;
      overflow-y: auto;
    }

    .html {
      overflow-y: auto;
    }

    @keyframes spin {
      to {
        -webkit-transform: rotate(360deg);
      }
    }

    @-webkit-keyframes spin {
      to {
        -webkit-transform: rotate(360deg);
      }
    }
  </style>
  <link href="/assets/css/chunk-vendors.63553963.css" rel="preload" as="style">
  <link href="/assets/css/index.2b37fa2c.css" rel="preload" as="style">
  <link href="/assets/js/chunk-vendors.f338542b.js" rel="preload" as="script">
  <link href="/assets/js/index.e8d0178a.js" rel="preload" as="script">
  <link href="/assets/css/chunk-vendors.63553963.css" rel="stylesheet">
  <link href="/assets/css/index.2b37fa2c.css" rel="stylesheet">
</head>

<body class="body"><noscript>You need to enable JavaScript to run this app.</noscript>
  <div id="app">
    <div class="loading"></div>
  </div>
  <script src="/assets/js/chunk-vendors.f338542b.js"></script>
  <script src="/assets/js/index.e8d0178a.js"></script>
</body>

</html>