<?php
/**
 * Created by PhpStorm.
 * User: haqury
 * Date: 06.10.18
 * Time: 15:01
 */

?>
<form class="js-buy" >

    <div>
        <label>maney</label>
        <label><?= $purse->getMoney() ?></label>
    </div>
    <div>
        <label>maney</label>
        <input name="id" class="js-maney" value="<?= $purse->getId() ?>" style ='display: none'/>
        <?php if($purse->gettra) ?>
        <input name="id" class="js-maney" value="<?= $purse->getId() ?>" style ='display: none'/>
        <input name="money" class="js-maney"/>
    </div>
</form>
</div>

<button class="js-buy">
    <span class="label">снять деньги</span>
</button>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="js/home.js"></script>
<script>Controller_Home.init()</script>

