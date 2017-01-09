<?php session_start(); ?>

    <div class="container">
      <form action="test.php" method='post'>
        <fieldset>
            <legend>First and Only Question:</legend>
            <div class ="column"><strong>Can you run this game? </strong></div> 
            <?php
              require("parseId.php");
            ?>
        </fieldset>
    </form>
    </div> <!-- /container -->
      

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

