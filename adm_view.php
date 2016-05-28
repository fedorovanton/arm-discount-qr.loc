<?php include('nav.php');?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2><img src="img/logo.png"></h2>
            <h2 style="color: #fff">Список скидок</h2>

            <table class="table adm-table-view">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Значение</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($discounts as $key => $val): ?>
                    <form method="post" action="">
                    <tr>
                        <td>
                            <input type="text" name="discount_id" class="form-control" value="<?=$val['discount_id']?>" readonly>
                        </td>
                        <td>
                            <input type="text" name="name" class="form-control" value="<?=$val['name']?>">
                        </td>
                        <td>
                            <input type="text" name="value" class="form-control" value="<?=$val['value']?>">
                        </td>
                        <td>
                            <button type="submit" name="upd" class="btn btn-block btn-primary">Сохранить</button>
                            <button type="submit" name="del" class="btn btn-block btn-warning">Удалить</button>
                        </td>
                    </tr>
                    </form>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if($_SESSION['message']): ?>
                <?=$_SESSION['message']?>
            <?php unset($_SESSION['message']); endif; ?>
        </div>
    </div>
</div> <!-- /container -->

</body>
</html>
