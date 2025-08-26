// document.addEventListener('DOMContentLoaded', function() {
//     fetch('fetchEvents.php')
//     .then(response => response.json())
//     .then(events => {
//         const eventsDiv = document.getElementById('events');
//         events.forEach(event => {
//             const div = document.createElement('div');
//             div.innerHTML = `<h2>${event.eventTitle}</h2><p>${event.eventDescription}</p> <p>${event.eventLocation}</p>`;
//             eventsDiv.appendChild(div);
//         });
//     });
// });



// document.addEventListener('DOMContentLoaded', function() {
//     fetch('fetchEvents.php')
//     .then(response => response.json())
//     .then(events => {
//         const eventsDiv = document.getElementById('events');
//         events.forEach(event => {
//             const div = document.createElement('div');
//             div.innerHTML = `
//                 <h2>${event.eventTitle}</h2>
//                 <p>${event.eventDescription}</p>
//                 <p>${event.eventLocation}</p>
//                 <input type="checkbox" class="event-checkbox" data-event-id="${event.id}">
//                 <button onclick="approveEvent(${event.id})">Approve</button>
//                 <button onclick="rejectEvent(${event.id})">Reject</button>
//             `;
//             eventsDiv.appendChild(div);
//         });
//     });
// });

// function approveEvent(event_id) {
//     if(confirm("Are you sure you want to approve this event?")) {
//         fetch(`approve_event.php?event_id=${event_id}`, { method: 'POST' })
//         .then(response => location.reload());
//     }
// }

// function rejectEvent(event_id) {
//     if(confirm("Are you sure you want to reject this event?")) {
//         fetch(`reject_event.php?event_id=${event_id}`, { method: 'POST' })
//         .then(response => location.reload());
//     }
// }



document.addEventListener('DOMContentLoaded', function() {
    fetch('fetchEvents.php')
      .then(response => response.json())
      .then(events => {
        const eventsDiv = document.getElementById('events');
        events.forEach(event => {
          const div = createEventItem(event); // Use the createEventItem function
          eventsDiv.appendChild(div);
        });
      });
  });
  
  // Create a function to generate event items for better organization
  function createEventItem(event) {
    const div = document.createElement('div');
    div.innerHTML = `
      <h2>${event.eventTitle}</h2>
      <p>${event.eventDescription}</p>
      <p>${event.eventLocation}</p>
      <input type="checkbox" class="event-checkbox"  data-event-id="${event.id}">
      <button class="approve-button">Approve</button>
      <button class="reject-button">Reject</button>
    `;
  
    // Add event listeners for buttons
    div.querySelector('.approve-button').addEventListener('click', () => approveEvent(event.id));
    div.querySelector('.reject-button').addEventListener('click', () => rejectEvent(event.id));
  
    return div;
  }
  
  // Function to approve an event
  function approveEvent(event_id) {
    if (confirm("Are you sure you want to approve this event?")) {
      fetch(`approve_event.php?event_id=${event_id}`, { method: 'POST' })
        .then(response => {
          if (response.ok) {
            location.reload();
          } else {
            console.error('Error approving event:', response.statusText);
          }
        });
    }
  }
  
  // Function to reject an event
  function rejectEvent(event_id) {
    if (confirm("Are you sure you want to reject this event?")) {
      fetch(`reject_event.php?event_id=${event_id}`, { method: 'POST' })
        .then(response => {
          if (response.ok) {
            location.reload();
          } else {
            console.error('Error rejecting event:', response.statusText);
          }
        });
    }
  }
  