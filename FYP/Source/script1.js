// document.addEventListener("DOMContentLoaded", () => {
//     const addUniversityForm = document.getElementById("add-university-form");
//     const universityList = document.getElementById("university-items");

//     // Function to refresh the university list
//     function refreshUniversityList() {
//         universityList.innerHTML = ""; // Clear the current list

//         fetch("get_universities.php?action=get")
//             .then(response => response.json())
//             .then(data => {
//                 if (data.status === "success") {
//                     data.universities.forEach(university => {
//                         const universityItem = document.createElement("li");
//                         universityItem.textContent = `${university.id} - ${university.name} - ${university.location}`;
//                         universityList.appendChild(universityItem);
//                     });
//                 } else {
//                     console.error(data.message);
//                 }
//             })
//             .catch(error => {
//                 console.error("Error:", error);
//             });
//     }

//     // Add university form submission
//     addUniversityForm.addEventListener("submit", e => {
//         e.preventDefault();

//         // Using FormData to capture and send data
//         let formData = new FormData(addUniversityForm);

//         fetch("add_university.php?action=add", {
//             method: "POST",
//             body: formData // Send as FormData
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.status === "success") {
//                 refreshUniversityList();
//                 addUniversityForm.reset();
//             } else {
//                 console.error(data.message);
//             }
//         })
//         .catch(error => {
//             console.error("Error:", error);
//         });
//     });

//     // Function to delete a university
//     function deleteUniversity(id) {
//         let formData = new FormData();
//         formData.append('id', id);

//         fetch("delete_university.php?action=delete", {
//             method: "POST",
//             body: formData // Send as FormData
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.status === "success") {
//                 refreshUniversityList();
//             } else {
//                 console.error(data.message);
//             }
//         })
//         .catch(error => {
//                 console.error("Error:", error);
//         });
//     }

//     // Attach a click event to dynamically added delete buttons
//     universityList.addEventListener("click", e => {
//         if (e.target.tagName === "BUTTON") {
//             const id = e.target.getAttribute("data-id");
//             deleteUniversity(id);
//         }
//     });

//     // Initial load of university list
//     refreshUniversityList();
// });




// document.addEventListener('DOMContentLoaded', function () {
//     loadUniversities();

//     document.getElementById('add-university-form').addEventListener('submit', function (e) {
//         e.preventDefault();
//         const formData = new FormData(this);
//         fetch('add_university.php', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => response.text())
//         .then(data => {
//             alert(data);
//             loadUniversities();
//         });
//     });

//     document.getElementById('delete-university-form').addEventListener('submit', function (e) {
//         e.preventDefault();
//         const formData = new FormData(this);
//         fetch('delete_university.php', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => response.text())
//         .then(data => {
//             alert(data);
//             loadUniversities();
//         });
//     });
// });

// function loadUniversities() {
//     fetch('get_universities.php')
//         .then(response => response.json())
//         .then(data => {
//             const list = document.getElementById('university-items');
//             list.innerHTML = '';
//             data.forEach(university => {
//                 list.innerHTML += `<li>${university.id}, ${university.name}, ${university.location}</li>`;
//             });
//         });
// }



document.addEventListener('DOMContentLoaded', function () {
    // Fetch universities and update the list
    fetchUniversities();

    // Add event listener to the add university form
    document.getElementById('add-university-form').addEventListener('submit', function (event) {
        event.preventDefault();
        addUniversity();
    });

    // Add event listener to the delete university form
    document.getElementById('delete-university-form').addEventListener('submit', function (event) {
        event.preventDefault();
        deleteUniversity();
    });
});

function fetchUniversities() {
    fetch('get_universities.php')
        .then(response => response.json())
        .then(data => {
            const universityList = document.getElementById('university-items');
            universityList.innerHTML = '';
            data.forEach(university => {
                const listItem = document.createElement('li');
                listItem.textContent = `ID: ${university.id}, Name: ${university.name}, Location: ${university.location}`;
                universityList.appendChild(listItem);
            });
        });
}

function addUniversity() {
    const id = document.getElementById('id').value;
    const name = document.getElementById('name').value;
    const location = document.getElementById('location').value;

    fetch('add_university.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&name=${name}&location=${location}`,
    })
        .then(response => response.text())
        .then(data => {
            alert(data);
            fetchUniversities();
        });
}

function deleteUniversity() {
    const id = document.getElementById('id').value;

    fetch('delete_university.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}`,
    })
        .then(response => response.text())
        .then(data => {
            alert(data);
            fetchUniversities();
        });
}
