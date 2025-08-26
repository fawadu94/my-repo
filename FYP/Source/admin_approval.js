// document.addEventListener("DOMContentLoaded", () => {
//     const event_id = document.getElementById("event_id").value;
//     const approveButton = document.getElementById("approve-button");
//     const rejectButton = document.getElementById("reject-button");
  
//     // Function to fetch event details
//     function fetchEventDetails(event_id) {
//       const xhr = new XMLHttpRequest();
//       xhr.open("GET", `/admin_approval.php?event_id=${event_id}`, true);
//       xhr.onload = function () {
//         if (xhr.status === 200) {
//           const data = JSON.parse(xhr.responseText);
//           if (data.success) {
//             // Update UI with event details
//             const eventTitle = document.getElementById("event-title");
//             eventTitle.textContent = data.event.title;
  
//             // ...populate other event details using data received
  
//             // Enable buttons after details are loaded
//             approveButton.disabled = false;
//             rejectButton.disabled = false;
//           } else {
//             alert("Error fetching event details: " + data.message);
//           }
//         } else {
//           alert("Error connecting to server");
//         }
//       };
  
//       xhr.send();
//     }
  
//     // Fetch event details on page load
//     fetchEventDetails(event_id);
  
//     // Function to handle event approval
//     function handleApprove(event) {
//       event.preventDefault();
  
//       const xhr = new XMLHttpRequest();
//       xhr.open("POST", "/approve_event.php", true);
//       xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
//       const data = new FormData();
//       data.append("event_id", event_id);
  
//       xhr.onload = function () {
//         if (xhr.status === 200) {
//           const response = JSON.parse(xhr.responseText);
//           if (response.success) {
//             alert("Event approved successfully!");
  
//             // Update UI with approved status
//             // ... (e.g., display a success message, disable buttons, etc.)
  
//             // Optionally, update event status in the UI based on response data
//             // ...
  
//             // Consider redirecting the user to another page (optional)
//             // ...
//           } else {
//             alert("Error approving event: " + response.message);
//           }
//         } else {
//           alert("Error connecting to server");
//         }
//       };
  
//       xhr.send(data);
//     }
  
//     // Function to handle event rejection
//     function handleReject(event) {
//       event.preventDefault();
  
//       const xhr = new XMLHttpRequest();
//       xhr.open("POST", "/reject_event.php", true);
//       xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
//       const data = new FormData();
//       data.append("event_id", event_id);
  
//       xhr.onload = function () {
//         if (xhr.status === 200) {
//           const response = JSON.parse(xhr.responseText);
//           if (response.success) {
//             alert("Event rejected successfully!");
  
//             // Remove event from UI
//             // ... (e.g., remove event details from the page)
  
//             // Consider redirecting the user to another page (optional)
//             // ...
//           } else {
//             alert("Error rejecting event: " + response.message);
//           }
//         } else {
//           alert("Error connecting to server");
//         }
//       };
  
//       xhr.send(data);
//     }
  
//     // Attach event listeners to buttons
//     approveButton.addEventListener("click", handleApprove);
//     rejectButton.disabled = true; // disable buttons until details are loaded
//     rejectButton.addEventListener("click", handleReject);
//   });

document.addEventListener("DOMContentLoaded", function() {
  fetchEvents();

  // Fetch and display events with checkboxes
  function fetchEvents() {
      fetch('fetchEvents.php')
      .then(response => response.json())
      .then(events => {
          const eventsSection = document.getElementById('event-details');
          events.forEach(event => {
              const eventDiv = document.createElement('div');
              eventDiv.innerHTML = `
                  <input type="checkbox" id="event_${event.event_id}" name="event" value="${event.event_id}">
                  <label for="event_${event.event_id}">${event.eventTitle}</label>
                  <!-- Add other event details here -->
              `;
              eventsSection.appendChild(eventDiv);
          });
      });
  }
});


