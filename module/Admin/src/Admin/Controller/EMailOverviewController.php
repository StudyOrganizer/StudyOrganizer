<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class EMailOverviewController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->getServiceLocator()->get('AdminUIPermissionService')->hasRightToAccessAdminUi($this)) {
            $this->layout('layout/layout.phtml');


            if ($this->getRequest()->isPost()) {
                $this->sendEMail();
            }

            return new ViewModel();
        } else {
            return $this->getServiceLocator()->get('AdminUIPermissionService')->performNoPermission($this);
        }
    }


    public function sendEMail() {
            $html = '<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Willkommen bei StudyOrganizer</title>
<style>
/* -------------------------------------
    GLOBAL
------------------------------------- */
* {
  font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
  font-size: 100%;
  line-height: 1.6em;
  margin: 0;
  padding: 0;
}
img {
  max-width: 600px;
  width: 100%;
}
body {
  -webkit-font-smoothing: antialiased;
  height: 100%;
  -webkit-text-size-adjust: none;
  width: 100% !important;
}
/* -------------------------------------
    ELEMENTS
------------------------------------- */
a {
  color: #348eda;
}
.btn-primary {
  Margin-bottom: 10px;
  width: auto !important;
}
.btn-primary td {
  background-color: #348eda;
  border-radius: 25px;
  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
  font-size: 14px;
  text-align: center;
  vertical-align: top;
}
.btn-primary td a {
  background-color: #348eda;
  border: solid 1px #348eda;
  border-radius: 25px;
  border-width: 10px 20px;
  display: inline-block;
  color: #ffffff;
  cursor: pointer;
  font-weight: bold;
  line-height: 2;
  text-decoration: none;
}
.last {
  margin-bottom: 0;
}
.first {
  margin-top: 0;
}
.padding {
  padding: 10px 0;
}
/* -------------------------------------
    BODY
------------------------------------- */
table.body-wrap {
  padding: 20px;
  width: 100%;
}
table.body-wrap .container {
  border: 1px solid #f0f0f0;
}
/* -------------------------------------
    FOOTER
------------------------------------- */
table.footer-wrap {
  clear: both !important;
  width: 100%;
}
.footer-wrap .container p {
  color: #666666;
  font-size: 12px;

}
table.footer-wrap a {
  color: #999999;
}
/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1,
h2,
h3 {
  color: #111111;
  font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
  font-weight: 200;
  line-height: 1.2em;
  margin: 40px 0 10px;
}
h1 {
  font-size: 36px;
}
h2 {
  font-size: 28px;
}
h3 {
  font-size: 22px;
}
p,
ul,
ol {
  font-size: 14px;
  font-weight: normal;
  margin-bottom: 10px;
}
ul li,
ol li {
  margin-left: 5px;
  list-style-position: inside;
}
/* ---------------------------------------------------
    RESPONSIVENESS
------------------------------------------------------ */
/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
  clear: both !important;
  display: block !important;
  Margin: 0 auto !important;
  max-width: 600px !important;
}
/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
  padding: 20px;
}
/* This should also be a block element, so that it will fill 100% of the .container */
.content {
  display: block;
  margin: 0 auto;
  max-width: 600px;
}

.content table {
  width: 100%;
}
</style>
</head>

<body bgcolor="#f6f6f6">

        <!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6">
  <tr>
    <td></td>
    <td class="container" bgcolor="#FFFFFF">

      <!-- content -->
      <div class="content">
      <table>
        <tr>
            <p>Hallo [*Name*], herzlich Willkommen bei StudyOrganizer!</p>
            <p>Schön, dass du Interesse hast unsere Software zu nutzen. Mit dieser Email senden wir dir deine Zugangsdaten, die Du für die erste Anmeldung brauchst.</p>
            <p>Hier sind ein paar erste Schritte, die Du befolgen solltest:</p>
            <ul>
                <li>1. Ändere bitte sofort nach dem ersten Login Dein Passwort unter >Mein Account< - >Einstellungen<. (Den Zahlen- und Buchstabensalat kann sich eh keiner merken ;-P )</li>
                <li>2. Unsere Software benötigt deinen korrekten Stundenplan, denn über den Stundenplan werden die Zuordnungen zu deinen Hausaufgaben, Klassenarbeiten und anderen Terminen hergestellt. Du kannst ihn eintragen, indem du oben auf das >Kalender<-Icon drückst.</li>
                <li>3. Damit StudyOrganizer Dir anzeigen kann, in welchen Fächern Du wann mit Lernen beginnen solltest, musst du unter >Mein Account< >Einstellungen<-  >Fähigkeiten< eintragen, wie gut oder schlecht du in einem Fach bist.</li>
                <li>4. Wenn du diese Schritte befolgt hast, steht einem gut organisierten Schulalltag so gut wie nichts mehr im Wege :)</li>
            </ul>
            <br />
            <p>Deine Benutzerdaten: <br />
            Benutzername: test <br />
            Passwort: test</p> <br/>
            <!-- button -->
            <table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td>
                  <a href="https://cbs.studyorganizer.de/login">CBS-Login</a>
                </td>
              </tr>
            </table>
            <!-- /button -->
            <p>Viel Spaß</p>
            <p>Das StudyOrganizer Team</p>
          </td>
        </tr>
      </table>
      </div>
      <!-- /content -->

    </td>
    <td></td>
  </tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
  <tr>
    <td></td>
    <td class="container">

      <!-- content -->
      <div class="content">
        <table>
          <tr>
            <td align="center">
              <p>&copy; 2015 StudyOrganizer. Alle Rechte vorbhalten</a>.
              </p>
            </td>
          </tr>
        </table>
      </div>
      <!-- /content -->

    </td>
    <td></td>
  </tr>
</table>
<!-- /footer -->

</body>
</html>';

            $message = new Message();
            $message->addFrom("beemo@studyorganizer.de", "StudyOrganizer")
                ->addTo("bjoern.ternes@gmail.com")
                ->setSubject("Willkommen bei StudyOrganizer");
            $bodyMessage = new \Zend\Mime\Part($html);
            $bodyPart = new \Zend\Mime\Message();
            $message->addReplyTo("bjoern.ternes@gmail.com", "Björn Ternes");
            $message->setEncoding("UTF-8");
            $bodyMessage->type = 'text/html';
            $bodyPart->setParts(array($bodyMessage));
            $message->setBody($bodyPart);
            $transport = new SendmailTransport();
            $transport->send($message);
    }

}
