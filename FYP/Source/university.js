const universityList = document.getElementById("university-list");

function fetchUniversities() {
    fetch("\get_university.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                for (const university of data.universities) {
                    const listItem = document.createElement("li");
                    listItem.textContent = university.name;
                    universityList.appendChild(listItem);
                }
            } else {
                console.error(data.message);
            }
        })
        .catch(error => {
            console.error(error);
        });
}

fetchUniversities();
