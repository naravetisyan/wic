$('.table').hide();
$('.places_form').submit(function(e) {
    e.preventDefault();
    var places = [],
        country = $('#select_country').val(),
        zip_code = $('#select_zip_code').val();

    if(!zip_code.length) {
    	$('.smt-wrong').empty();
    	$('.smt-wrong').append('Please enter zip code!')
    } else {
    	$('.smt-wrong').empty();
    	$('.smt-wrong').append('<strong>Danger!</strong> Wrong zip code or country')
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Origin': '*'
        }
    });
    $.ajax({
        type:'POST',
        url:'/places',
        data: {
            country,
            zip_code
        },
        success:function(data) {
            if(!data.length){
                var req = new XMLHttpRequest();
                req.open("GET", `http://api.zippopotam.us/${country}/${zip_code}`, true);
                req.onreadystatechange = function() {
                    if(req.status != 200) {
                        $('#select_zip_code').addClass('is-invalid');
                        $('.invalid-feedback').show();
                        $('.table').hide();
                    } else if(req.readyState == 4) {
                        let res = JSON.parse(req.response);
                        console.log(res.places);
                        $.ajax({
                            type:'POST',
                            url: '/',
                            data: { 
                                places: res.places,
                                zip_code: res["post code"],
                                country: res["country"] 
                            },
                            success: function(data) {
                                showTable(res.places);
                            }
                        })
                    };
                };
                req.send();
            } else {
                places = data;
                showTable(places);
            }
        }
    }); 
})

function showTable(places) {
    $('#select_zip_code').removeClass('is-invalid');
    $('.invalid-feedback').hide();
    $('.table tbody').empty();
    $('.table').show();                        
    places.forEach((place, index) => {
        place["name"] = place["name"] ? place["name"] : place["place name"]
        let data = '<tr><th scope="row">' + (index + 1) + '</th>';
        data += '<td>' + place["name"]  + '</td>';
        data += '<td>' + place["latitude"] + '</td>'
        data += '<td>' + place["longitude"] + '</td></tr>';
        $('.table tbody').append(data);
    })
}