<!--
Template found on https://freefrontend.com/css-login-forms/
Author : Mikael Ainalem, 12/02/2018
Modified and adapted by : Tristan Lieberherr, 19/07/2021
-->
<!DOCTYPE html>
<html lang="en" class="html">

<head>
  <style>
    body {
      background: white;
      font-family: 'Inter UI', sans-serif;
      margin: 0;
      padding: 20px;
    }

    .page {
      background: #e2e2e5;
      display: flex;
      flex-direction: column;
      height: calc(100% - 40px);
      position: absolute;
      place-content: center;
      width: calc(100% - 40px);
    }

    @media (max-width: 767px) {
      .page {
        height: auto;
        margin-bottom: 20px;
        padding-bottom: 20px;
      }
    }

    .container {
      display: flex;
      height: 320px;
      margin: 0 auto;
      width: 640px;
    }

    @media (max-width: 767px) {
      .container {
        flex-direction: column;
        height: 630px;
        width: 320px;
      }
    }

    .left {
      background: white;
      height: calc(100% - 40px);
      top: 20px;
      position: relative;
      width: 50%;
    }

    @media (max-width: 767px) {
      .left {
        height: 100%;
        left: 20px;
        width: calc(100% - 40px);
        max-height: 270px;
      }
    }
  </style>
</head>

<body>
  <div class="page">
    <div class="container">
      <div class="left">
        <img src="{{ asset('img/heig_2020.svg') }}" alt="" style="margin: 20px">
      </div>
      <div class="left">
        <h2>Bienvenue sur la plateforme des demandes de travaux du FabLab HEIG-VD</h2>
        <div>
          <p>Merci de vous connecter pour continuer</p>
          <div style="text-align: center">
            <a href="/shibboleth-login"><button>Se connecter</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <noscript>
    <p>
      <strong>Login:</strong> Javascript is not enabled for your web browser. Please use the <a
        href="/Shibboleth.sso/DS?target=https%3A%2F%2Ftb21-lieberherr.heig-vd.ch%2F">non-Javascript Login</a>.
    </p>
  </noscript>
</body>

</html>