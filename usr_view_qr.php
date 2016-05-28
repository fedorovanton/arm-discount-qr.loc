<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2><img src="img/logo.png"></h2>
            <?php if (isset($_REQUEST['user_id']) and isset($_REQUEST['discount_id'])):?>
                <h2 style="text-align: center"><img src="<?=$PNG_WEB_DIR.basename($filename)?>" /></h2>
            <?php endif; ?>
            <h2 style="color: #fff">Список QR-скидок</h2>

            <table class="table adm-table-view">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Пользователь</th>
                        <th>Скидка</th>
                        <th>QR-код</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($users_discounts): ?>
                        <?php foreach($users_discounts as $key => $val): ?>
                            <form method="post" action="">
                                <tr>
                                    <td>
                                        <input type="text" name="user_discount_id" class="form-control" id="exampleInputEmail1" style="width: 50px;" value="<?=$val['user_discount_id']?>" readonly>
                                    </td>
                                    <td>
                                        <?=$val['user_name']?>
                                    </td>
                                    <td>
                                        <?=$val['discount_name']?>
                                    </td>
                                    <td>
                                        <img src="<?=$val['code']?>">
                                    </td>
                                </tr>
                            </form>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">
                                У Вас QR-скидок ещё нет.
                            </td>
                        </tr>
                    <?php endif; ?>
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
