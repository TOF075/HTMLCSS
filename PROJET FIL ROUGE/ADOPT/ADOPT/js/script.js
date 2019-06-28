$('.inputSIRET').attr('disabled', 'true');

$('.inputNomSociete').on('input', (e) => { 
    //fonction qui fait qu'on puisse reconnaître si ça appartient à la BDD
    // if... ===> appartient à la BDD (société déjà connue)
    if (e.target.value.substr(0,5) === 'SIRET'){
        var siret = e.target.value.substr(6, 14); 
        var lengthCN = e.target.value.length-22;
        var CompanyName = e.target.value.substr(21, lengthCN);
        e.target.value = CompanyName;
        $('.inputSIRET').removeAttr('disabled').val(siret).attr('readonly', true);
    } else{
        $('.inputSIRET').removeAttr('disabled').removeAttr('readonly').val(''); 
        $('.submitForm').attr('disabled', 'true');
    }
});

$('.inputSIRET').on('input', (e) => {
    if(e.target.value.length < 14 || e.target.value.length > 15 ){
        $('.submitForm').attr('disabled', 'true');
    }else{
        $('.submitForm').removeAttr('disabled');
    }
})

