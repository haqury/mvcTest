<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 15:01
 */

?>
<form class="js-buy_form" >

    <div>
        <label>maney</label>
        <label><?= $purse->getMoney() ?></label>
        <input name="id" value="<?php echo $purse->getId() ?>" style ='display: none'/>

    </div>
    <div>
        <label>maney</label>
        <input name="money" value="<?= !empty($_POST['money']) ? $_POST['money'] : 0 ?>"/>
        <?php if(!empty($purse->getTransactionCode())){?>
            <input name="transactionCode"/>
        <?php } ?>
    </div>
</form>
</div>

<button class="js-buy">
    <span class="label">снять деньги</span>
</button>
<?= $transactionResult ?>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="js/home.js"></script>
<?php if (empty($_POST)) { ?>
    <script>Controller_Home.init()</script>
<?php } ?>

