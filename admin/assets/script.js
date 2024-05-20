
$(document).ready(function() {
    alertify.set('notifier','position', 'top-right');
    // alert
    setTimeout(()=>{
        $('#status_alert').fadeOut('slow');
    }, 4000);

    // select
    $('.form-select-field').select2();
    // quantity
    $(document).on('click', '.increment', function(){
        var quantityInput = $(this).closest('.qtyBox').find('.qty');
        var produitId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt(quantityInput.val());
        if(!isNaN(currentValue))
        {
            var qtyVal = currentValue +1;
            quantityInput.val(qtyVal);
            quantityIncDec(produitId, qtyVal);
        }

    });
    $(document).on('click', '.decrement', function(){
        var quantityInput = $(this).closest('.qtyBox').find('.qty');
        var produitId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt(quantityInput.val());
        if(!isNaN(currentValue)&& currentValue >1)
        {
            var qtyVal = currentValue -1;
            quantityInput.val(qtyVal);
            quantityIncDec(produitId, qtyVal);
        }

    });
    function quantityIncDec(produitId, qty)
    {
        $.ajax({
            type: 'POST',
            url: "/pdv-systeme/admin/orders/code.php",
            data: {
                "produitIncDec": true,
                'produit_id': produitId,
                'quantity': qty,
            }, 
            success: function(response){
                if(response.status == 200)
                {
                    // window.location.reload();
                    $('#produitArea').load(" #produitContent");
                    alertify.success(response.message);
                }else{
                    $('#produitArea').load(" #produitContent");
                    alertify.error(response.message);
                }

            }
        });
    }
    // proceed to place order
    $(document).on('click', '.proceedToPlace', function(){
       var payement_method = $('#payement_mode').val();
       var customer_id = $('#customerId').val();
       console.log(customer_id);
       if(payement_method=="")
        {
            swal("Payement Methode", "Sélectionnez le mode de payement", 'warning');
            return false;
        }
        if(customer_id==null || typeof customer_id === Number)
        {
            swal("Client", "Sélectionnez le nom du Client", 'warning');
            return false;

        }

        var data ={
            'proceedToPlace': true,
            'customer_id': customer_id,
            'payement_mod': payement_method
        };
        $.ajax({
            type: 'POST',
            url: "/pdv-systeme/admin/orders/code.php",
            data: data, 
            success: function(response){
                if(response.status == 200)
                {
                    // alertify.success(response.message);
                    window.location.href = "/pdv-systeme/admin/orders/order-summary";

                }else if(response.status == 404){
                    swal(response.message, response.status_type, response.message);
                }

            }
        });


    });
    // show modal add client
    $(document).on('click', '#addClient', function(){
        $('#addClientModal').modal('show');
    });
    
    // add client
    $(document).on('click', '.saveClient', function(){
        var name = $('#c_name').val();
       var phone = $('#c_phone').val();
       var email = $('#c_email').val();
       if(name!="" && phone !="")
        {
            var data ={
                'saveClient': true,
                'name': name,
                'phone': phone,
                'email': email
            };
            $.ajax({
                type: 'POST',
                url: "/pdv-systeme/admin/clients/code.php",
                data: data, 
                success: function(response){
                    // var resp = JSON.parse(response);
                    if(response.status == 200)
                    {
                        swal("Succès", response.message, response.status_type);
                        $('#addClientModal').modal('hide');
                        $('#produitArea').load(" #produitContent");
    
                    }else if(response.status == 422){
                        swal("Champs requis", response.message, response.status_type);
                    }
                    else if(response.status == 203){
                        swal("Informations non autorisées", response.message, response.status_type);
                    }
                    else if(response.status == 500){
                        swal("Erreur Interne du Serveur", response.message, response.status_type);
                    }
                    else{
                        swal("Error", response.message, response.status_type);
                    }
    
                },
                error: function(error)
                {
                    console.log(error);
                }
                
            });
        }
        else{
            swal("Champs vides", "Veillez renseignez les champs nécessaires", 'warning');
            return false;
        }
        

        
    });

    // save order
    
    $(document).on('click', '#saveOrder', function(){
        $.ajax({
            type: 'POST',
            url: "/pdv-systeme/admin/orders/code.php",
            data: {
                'saveOrder': true
            },
            success: function(response){

                if(response.status == 200)
                {
                    swal("Succès", response.message, response.status_type);
                    $('#orderPlaceSuccess').text( response.message);
                    $('#orderSuccessModal').modal('show');

                }
                else{
                    swal("Error", response.message, response.status_type);
                }
    
            },
            error: function(error)
            {
                console.log(error);
            }
        })
    });
    
});
// print billing
function printBillingArea()
{
    var divContents = document.getElementById('myBillingArea').innerHTML;
    var a = window.open('', '');
    a.document.write('<html><title>PDV Système</title>');
    a.document.write('<body style="font-family: fangsong;">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
}
// download
window.jsPDF = window.jspdf.jsPDF;
// const { jsPDF } = window.jspdf;
var docPDF = new jsPDF();
function downloadPDF(invoiceNo)
{
    var elementHTML = document.querySelector('#myBillingArea');
   docPDF.html( elementHTML, {
    callback: function(){
        docPDF.save(invoiceNo+'.pdf'); 
    },
    x:15,
    y:15,
    width:170,
    windowWidth: 650
   });
}
