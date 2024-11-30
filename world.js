window.onload = () => {
    const lookup_button = document.getElementById("lookup");
    const country_input = document.getElementById("country");
    const result_container = document.getElementById("result");

    lookup_button.addEventListener("click", () => {
        const country = country_input.value;
        // console.log(`this is the value of ${country}`);

        fetch(`world.php?country=${encodeURIComponent(country.trim())}`)
        .then((response) => response.text())
        .then((data) => {
            result_container.innerHTML = data;
        })
        .catch((error) => {
            console.log(error);
        })

        // try {
        //     // Make the fetch request and wait for the response
        //     const response = await fetch(`world.php?query=${encodeURIComponent(country.trim())}`);
            
        //     // Wait for the response text to be resolved
        //     const data = await response.text();
            
        //     // Update the result container with the fetched data
        //     result_container.innerHTML = data;
        // } catch (error) {
        //     // Catch and log any errors
        //     console.log(error);
        // }
    })

    const lookup_button_cities = document.getElementById("lookup-cities");

    lookup_button_cities.addEventListener("click", () => {
        const country = country_input.value;
        // console.log(`this is the value of ${country}`);

        fetch(`world.php?country=${encodeURIComponent(country.trim())}&lookup=cities`)
        .then((response) => response.text())
        .then((data) => {
            console.log(data);
            result_container.innerHTML = data;
        })
        .catch((error) => {
            console.log(error);
        })

        // try {
        //     // Make the fetch request and wait for the response
        //     const response = await fetch(`world.php?query=${encodeURIComponent(country.trim())}`);
            
        //     // Wait for the response text to be resolved
        //     const data = await response.text();
            
        //     // Update the result container with the fetched data
        //     result_container.innerHTML = data;
        // } catch (error) {
        //     // Catch and log any errors
        //     console.log(error);
        // }
    })

}