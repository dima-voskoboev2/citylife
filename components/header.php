<button onclick="topFunction()" id="myBtn" title="подняться на вверх страницы">наверх</button>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">🏙️ Жизнь города</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
            <a class="nav-link" href="/index.php">Главная <span class="sr-only">(current)</span></a>
            </li>
	        <li class="nav-item">
            <a class="nav-link" href="/about.php">О городе <span class="sr-only">(current)</span></a>
            </li>		
			
            <?php if ($_SESSION['user']) { ?>
            <li class="nav-item">
            <a class="nav-link" href="/user-posts.php">Мои впечатления <span class="sr-only">(current)</span></a>
            </li>
            <?php } if ($_SESSION['user']['flag'] == 1) { ?>
            <li class="nav-item">
            <a class="nav-link" href="/admin-post-list.php">Список впечатлений <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/admin-user-list.php">Список пользователей <span class="sr-only">(current)</span></a>
            </li>
            <?php } if (!$_SESSION['user']) { ?>
            <li class="nav-item">
            <a class="nav-link" href="/login.php">Войти <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/register.php">Регистрация <span class="sr-only">(current)</span></a>
            </li>
            <?php } if ($_SESSION['user']) { ?>
            <li class="nav-item">
            <a class="nav-link" href="/functions/f_logout.php">Выйти (<?php echo $_SESSION['user']['username']; ?>) <span class="sr-only">(current)</span></a>
            </li>
            <?php } ?>
        </ul>
        </div>
    </div>
</nav>
<script>
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			document.getElementById("myBtn").style.display = "block";
		} else {
			document.getElementById("myBtn").style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}		
</script>