<header id="header">
    <div class="top_nav">
        <div class="headerz" >
            <ul class="ul_button">
                <?php if (!isset($_SESSION['user'])) { ?>
                    <a href="./register"><button type="button" class="nes-btn is-primary">Register</button></a>
                    <a href="./login"><button type="button" class="nes-btn is-success">Login</button></a>

                <?php } else { ?>
                        <a href="./myListCreate" class="nes-btn">Create task</a>
                        <a href="./profile"><button type="button" class="nes-btn is-warning">Profil</button></a>
                        <a href="./logout"><button type="button" class="nes-btn is-error">Logout</button></a>
                        
                    <?php } ?>
            </ul>
        </div>
    </div>
</header>