$(document).ready(function () {
    console.log("jadi");
    $('#nomor_aset').click(function(){
        console.log('jadi');
        var val = $(this).val();
        $.ajax({
            type: 'POST',
            url: "nomor.php",
            data: "data="+val,
            success: function (hasil) {
                $("#nama_aset").val(hasil);
            }
        });
    });
     //contextMenu();
    // maintenance();    
    // simpanIp();    
    $("#moneyInput, #money_input, .currency_input, .money").maskMoney(
        {thousands: '.', decimal: ',', prefix: 'Rp. ', affixesStay: false, precision: 0}
    );    
});
function numberMobile(e){
    e.target.value = e.target.value.replace(/[^\d]/g,'');
    return false;
}
function hanyaAngka(evt) {
    var charCode = (evt.which)?evt.which:event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) 
        return false;
    return true;
}
