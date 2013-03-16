<form action="<?php echo $action; ?>" method="post">
<div class="buttons">
    <div class="right">
        <input type="hidden" name="BuyerEmail" value="<? echo $BuyerEmail ?>"> 
        <input type="hidden" name="AgentID" value="<? echo $AgentID ?>"> 
        <input type="hidden" name="Description" value="<? echo $Description ?>"> 
        <input type="hidden" name="SellerEmail" value="<? echo $SellerEmail ?>"> 
        <input type="hidden" name="Cost" value="<? echo $Cost ?>"> 
        <input type="hidden" name="ExtraCost" value="<? echo $ExtraCost ?>"> 
        <input type="hidden" name="OkUrl" value="<? echo $OkUrl ?>"> 
        <input type="hidden" name="CancelUrl" value="<? echo $CancelUrl ?>"> 
        <input type="hidden" name="RefNr" value="<? echo $RefNr ?>"> 
        <input type="hidden" name="MD5" value="<? echo $MD5Hash ?>"> 
        <input type="hidden" name="GuaranteeOffered" value="<? echo $GuaranteeOffered ?>"> 
        <input type="hidden" name="PaymentMethod" value="<? echo $PaymentMethod ?>"> 
        <input type="submit" value="<?php echo $button_confirm; ?>" id="button-confirm" class="btn" />
    </div>
</div>
</form>
