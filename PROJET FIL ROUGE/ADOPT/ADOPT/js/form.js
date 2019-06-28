$('.companyForm').hide();

$('.selectStatus').change( (e) => { 
    var choice = e.target.value;
    
    if(choice !== 'Choisir' ){
        $('.submitForm1').removeAttr('disabled');
    }
    if(choice === 'Ressources Humaines' ||  choice === 'Societe'){
        $('.companyForm').show();
        $('.submitForm1').hide();
        $('.already1').hide();
        $('.CompanySIRETInput').attr('required', 'true'); 
        if(choice !== 'Societe'){
            $('.CompanySIRETInput').attr('disabled', 'true');
        }else{
            $('.CompanySIRETInput').removeAttr('disabled'); 
            $('.CompanyNameInput').attr('required', 'true');
            
            $('.CompanyNameInput').change( (e) =>{
                var value = e.target.value;
                var verifyDB = value.substr(0, 5);
                
                if( verifyDB  === 'SIRET'){
                    var siret = value.substr(6, 14); 
                    var lengthCN = value.length-22;
                    var CompanyName = value.substr(21, lengthCN);
                    e.target.value = CompanyName;

                    $('.CompanySIRETInput').val(siret);
                } else{
                    $('.CompanySIRETInput').attr('placeholder','ex: 732 829 320 00074').removeAttr('disabled');
                }
            })    
        }
    } else{
        $('.companyForm').hide();
        $('.submitForm1').show();
        $('.already1').show();
        
    }
});