<?php

namespace giftbox\controller;

//redirction mode paiement

if (isset($_POST) && isset($_POST['groupe_radio1'])){
    if ($_POST['groupe_radio1'] =='classique'){
        echo " mode paiement classique";
    }elseif ($_POST['groupe_radio1'] =='cagnotte'){
        header('Location: ./CagnotteController.php');
    }
}
?>