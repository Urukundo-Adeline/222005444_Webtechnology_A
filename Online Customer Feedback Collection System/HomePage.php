<main class="main-container">
        <div class="main-title">
          <h2>DASHBOARD</h2>
          <h1>You are admin <?php echo $_SESSION['full_name']; ?></h1>
        </div>

        <div class="main-cards">

 <?php include_once("includes/cards.php"); ?>
        </div>

        <div class="charts">

       <?php include_once("includes/chart.php"); ?>

        </div>
      </main>