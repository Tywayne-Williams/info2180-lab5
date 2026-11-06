document.addEventListener("DOMContentLoaded", function () {
    const lookupButton = document.querySelector("#lookup");
    const citiesButton = document.querySelector("#lookup-cities");
    const resultDiv = document.querySelector("#result");
    const countryInput = document.querySelector("#country");

    lookupButton.addEventListener("click", function () {
        const country = countryInput.value;

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(function (response) {
                if (!response.ok) {
                    throw new Error("Could not retrieve country information.");
                }
                return response.text();
            })
            .then(function (data) {
                resultDiv.innerHTML = data;
            })
            .catch(function (error) {
                resultDiv.textContent = error.message;
            });
    });

    citiesButton.addEventListener("click", function(){
        const country = countryInput.value;

        fetch("world.php?lookup=cities" + encodeURIComponent(country))
        .then(function(response){
            if(!response.ok){
                throw new Error("Could not retrieve city information");
            }
            return response.text();
        })
        .then(function(data){
            resultDiv.innerHTML = data;
        })
        .catch(function(error){
            resultDiv.textContent = error.message;
        });
    });
});
