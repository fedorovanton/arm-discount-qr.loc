<?php include('nav.php');?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2><img src="img/logo.png"></h2>
            <?php if (isset($_REQUEST['user_id']) and isset($_REQUEST['discount_id'])):?>
                <h2 style="text-align: center"><img src="<?=$PNG_WEB_DIR.basename($filename)?>" /></h2>
            <?php endif; ?>
            <h2 style="color: #fff">Генерация QR-скидки</h2>

            <table class="table adm-table-view">
                <thead>
                    <tr>
                        <th>Пользователь</th>
                        <th>Скидка</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <form method="post" action="">
                    <tbody>
                        <tr>
                            <td>
                                <select name="user_id" class="form-control">
                                    <?php foreach($users as $key_u => $val_u): ?>
                                        <option value="<?=$val_u['user_id']?>"><?=$val_u['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select name="discount_id" class="form-control">
                                    <?php foreach($discounts as $key_d => $val_d): ?>
                                        <option value="<?=$val_d['discount_id']?>"><?=$val_d['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <button type="submit" name="add" class="btn btn-primary">Сгенерировать</button>
                            </td>
                        </tr>
                    </tbody>
                </form>
            </table>
            <?php if($_SESSION['message']): ?>
                <?=$_SESSION['message']?>
            <?php unset($_SESSION['message']); endif; ?>
        </div>
    </div>
</div> <!-- /container -->

</body>
</html>
