<?php
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
<div class="sidebar">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link active" href="menu.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z" />
                </svg>
                <?php echo $_SESSION['User1']; ?>
            </a>
        </li>
        <div class="dropdown-divider light"></div>
        <li class="nav-item">
            <a class="nav-link active" href="#!">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M22 2H2.01L2 22l4-4h16V2zM9 11H7V9h2v2zm4 0h-2V9h2v2zm4 0h-2V9h2v2z" /></svg>
                Foro (proximamente)
            </a>
        </li>
        <?php
        if ($_SESSION['Rol1'] == 1) {
            /**
             * Si es igual a Administrador o Maestro muestra esto: Cursalia
             */
        ?>
        <li class="nav-item" id="Cursos1">
            <a class="nav-link" href="cursos.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M4 6H2v16h16v-2H4V6zm18-4H6v16h16V2zm-2 10l-2.5-1.5L15 12V4h5v8z" /></svg>
                Lista de Cursos!
            </a>
        </li>
        <?php
        }
        ?>
        <?php
        if ($_SESSION['Rol1'] == 3 || $_SESSION['Rol1'] == 2) {
            /**
             * Si es igual a Administrador o Maestro muestra esto: Cursalia
             */
        ?>
        <li class="nav-item" id="Cursos1">
            <a class="nav-link" href="cursos.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M4 6H2v16h16v-2H4V6zm18-4H6v16h16V2zm-2 10l-2.5-1.5L15 12V4h5v8z" /></svg>
                Mis Cursos!
            </a>
        </li>
        <?php
        }
        ?>
        <?php
        if ($_SESSION['Rol1'] == 2) {
            /**
             * Si es igual a Administrador o Maestro muestra esto:
             */
        ?>
        <li class="nav-item">
            <a class="nav-link" href="grados.php">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
                Mis Grados
            </a>
        </li>
        <?php
        }
        ?>
        <?php
        if ($_SESSION['Rol1'] == 1) {
            /**
             * Si es igual a Administrador o Maestro muestra esto:
             */
        ?>
        <li class="nav-item">
            <a class="nav-link" href="grados.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                </svg>
                Lista de Grados
            </a>
        </li>
        <?php
        }
        ?>
        <div class="dropdown-divider light"></div>
        <?php
        if ($_SESSION['Rol1'] == 2) {
            /**
             * Si es igual a Administrador o Maestro muestra esto:
             */
        ?>
        <li class="nav-item">
            <a class="nav-link" href="calificar_actividades.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M21 3h-6.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H3v18h18V3zm-9 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-2 14l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
                </svg>
                Calificar Actividades
            </a>
        </li>
        <?php
        }
        ?>

        <?php
        if ($_SESSION['Rol1'] == 3) {
            /**
             * Si es igual a Administrador, Maestro o Alumno muestra esto:
             */
        ?>
        <li class="nav-item">
            <a class="nav-link" href="actividades_pendientes.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M21 3h-6.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H3v18h18V3zm-9 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                </svg>
                Actividades Pendientes
            </a>
        </li>
        <div class="dropdown-divider light"></div>
        <?php
        }
        ?>
        <?php
        if ($_SESSION['Rol1'] == 1) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="menu_direccion.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M4 10v7h3v-7H4zm6 0v7h3v-7h-3zM2 22h19v-3H2v3zm14-12v7h3v-7h-3zm-4.5-9L2 6v2h19V6l-9.5-5z" />
                </svg>
                Menu de Direccion
            </a>
        </li>
        <div class="dropdown-divider light"></div>
        <?php
        }
        ?>

        <li class="nav-item">
            <a class="nav-link" href="controlador/cierre_sesion.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M7 11v2h10v-2H7zm5-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                </svg>
                Cerrar Sesion!
            </a>
        </li>
    </ul>
</div>