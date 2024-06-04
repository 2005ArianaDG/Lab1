<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Pagos</title>

</head>
<body>
    <div class="container">
        <h1>Pagos</h1>
        <?php
            require_once 'db.php';

        function listarPagos(){
            $pagos = getPagos();
            ?>
                <ul class="list-group">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Deudor</th>
                                <th>Cuota</th>
                                <th>Cuota Capital</th>
                                <th>Fecha Pago</th>
                                <th>Estados</th>
                            </tr>
                        <thead>
                    </table>
                    <?php foreach($pagos as $pago) {
                        $classes = $pago->finalizado ? 'finalizado' : '';
                    ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="<?= $classes ?>"><?= $pago->deudor?></span>
                            <span class="<?= $classes ?>"><?= $pago->cuota?></span>
                            <span class="<?= $classes ?>"><?= $pago->cuota_capital?></span>
                            <span class="<?= $classes ?>"><?= $pago->fecha_pago?></span>
                            <div>
                                <a class= "btn btn-danger" href="index.php?delete=<?= $pago->id?>">Eliminar</a> 
                                    <?php if (!$pago->finalizado) {?>
                                        | <a class= "btn btn-info" href="index.php?complete=<?= $pago->id?>">Finalizar</a>
                                    <?php }?>
                            </div>
                    </li>
                    <?php } ?>
                </ul>

            <?php
        }
        listarPagos();
                
            if ($_SERVER['REQUEST_METHOD']=== 'POST') {
                $deudor = $_POST['deudor'];
                $cuota = $_POST['cuota'];
                $cuota_capital = $_POST['cuota_capital'];
                $fecha_pago = $_POST['fecha_pago'];
                addPagos($deudor, $cuota, $cuota_capital, $fecha_pago);
                header('Location: index.php');
            }
            if (isset($_GET['delete'])) {
                # code...
                deletePagos($_GET['delete']);
                header('Location: index.php');
            }
            if (isset($_GET['complete'])) {
                # code...
                completarPagos($_GET['complete']);
                header('Location: index.php');
            }
        ?>
        <form action="index.php" method="post">
            <div>
                <label for="deudor" class="form-label">Deudor</label>
                <input type="text" name="deudor" id="deudor" class="form-control">
            </div>
            <div>
                <label for="cuota" class="form-label">Cuota</label>
                <input type="text" name="cuota" id="cuota" class="form-control">
            </div>
            <div>
                <label for="cuota_capital" class="form-label">Cuota Capital</label>
                <input type="text" name="cuota_capital" id="cuota_capital" class="form-control">

            </div> 
            <div>
                <label for="fecha_pago" class="form-label">Fecha Pago</label>
                <input type="date" name="fecha_pago" id="fecha_pago" class="form-control">

            </div> 
            <button type="submit" class="btn btn-success">Agregar</button>
        </form>
    </div>
</body>
</html>