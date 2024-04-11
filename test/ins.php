<?php 
include 'conn.php';
include 'modal.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

/* Container styles */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    margin-top: 20px;
}

/* Heading styles */
h1 {
    color: #333;
    text-align: center;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

/* Table header styles */
table th {
    background-color: #f2f2f2;
}

/* Table row hover effect */
table tr:hover {
    background-color: #f9f9f9;
}

/* CSS for Approved status */
.status-approved {
            color: green;
        }

        /* CSS for Pending status */
.status-pending {
            color: #FFC94A;
        }
.status-rejected {
            color: red;
}
        
        .ellipsis {
    cursor: pointer;
    font-size: 200%;
    text-decoration: none;
    display: inline-block;
    position: relative;
    text-align: center;
    width: 1em; /* Adjust as needed */
    height: 1em; /* Adjust as needed */
    line-height: 1em; /* Adjust as needed */
}

.ellipsis:hover::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 150%; /* Adjust as needed */
    height: 150%; /* Adjust as needed */
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.1); /* Adjust the color and transparency as needed */
}
        /* CSS for options */
        .options {
    display: none;
    position: absolute;
    background-color: #EEEEEE; /* Background color */
    min-width: 120px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
    border-radius: 5px; /* Rounded corners */
    color: #FFFFFF; /* White text color */
}

.options button {
    color: #FFFFFF; /* White text color */
    border: none;
    padding: 8px 12px;
    margin: 4px;
    border-radius: 3px; /* Rounded corners */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition on hover */
    display: block; /* Ensure buttons are displayed as block elements */
    width: 100%; /* Full width */
}

.options button.approve {
    background-color: #90D26D; /* Green button background color */
}

.options button.reject {
    background-color: #A34343; /* Red button background color */
}
.modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<body>
    
<div class="container">
        <h1>Application List</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
             $sql = "SELECT id, firstName, lastName, email, conNum, date, status FROM contbl";
             $result = $conn->query($sql);
             
        

//end of file paths checking

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    echo "<tr onclick=\"openModal('$id')\">"; // Call openModal function on row click
                    echo "<td>" . $row["firstName"] . " " . $row["lastName"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["conNum"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";

                    // Set default status as Pending
                    $status = "Pending";

                    // If status is Approved or Rejected, update $status accordingly
                    if ($row["status"] == 1) {
                        $status = "Approved";
                    } elseif ($row["status"] == 2) {
                        $status = "Rejected";
                    }

                    // Apply status class based on status
                    $statusClass = ($row["status"] == 1) ? "status-approved" : (($row["status"] == 2) ? "status-rejected" : "status-pending");

                    // Display status in table cell
                    echo "<td class='$statusClass'>$status</td>";

                    echo "<td>";
                    // Show options if status is Pending
                    if ($row["status"] == 0) {
                        echo "<span class='ellipsis' onclick=\"toggleOptions('options_" . $row["id"] . "')\"><i class='bx bx-dots-horizontal-rounded' aria-hidden='true'></i></span>";
                        echo "<div class='options' id='options_" . $row["id"] . "'>";
                        echo "<button class='approve' onclick=\"approveApplication(" . $row["id"] . ")\">Approve</button>";
                        echo "<button class='reject' onclick=\"rejectApplication(" . $row["id"] . ")\" data-id='$id'>Reject</button>";
                        echo "</div>";
                    }
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
    
<div id="myModal" class="modal" >
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div id="fileContainer">
            <?php foreach ($file_paths as $file_type => $file_path) : ?>
                <?php if (!empty($file_path) && file_exists($file_path)) : ?>
                    <p>ID: <?php echo $id; ?></p>
                    <p><?php echo ucfirst($file_type) . ": "; ?><a href="<?php echo $file_path; ?>" target="_blank">View</a></p>
                    <img src="<?php echo $file_path; ?>" alt="<?php echo ucfirst($file_type); ?>">
                <?php else: ?>
                    <p>No <?php echo ucfirst($file_type); ?> available.</p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script>
function toggleOptions(id) {
    var options = document.getElementById(id);
    var allOptions = document.querySelectorAll('.options');
    
    // Close all options boxes
    allOptions.forEach(function(option) {
        if (option.id !== id) {
            option.style.display = 'none';
        }
    });

    // Toggle the selected options box
    if (options.style.display === "none" || options.style.display === "") {
        options.style.display = "block";
        optionBoxActive = true; // Set flag to true when an option box is active
        disableModal(); // Disable modal interactivity when an option box is active
    } else {
        options.style.display = "none";
        optionBoxActive = false; // Set flag to false when no option box is active
        enableModal(); // Enable modal interactivity when no option box is active
    }
}

// Add click event listener to document
document.addEventListener('click', function(event) {
    var optionsContainers = document.querySelectorAll('.options');
    // Loop through all options containers
    optionsContainers.forEach(function(container) {
        // Check if click target is outside the current options container and not the ellipsis icon
        if (!container.contains(event.target) && event.target.className !== 'ellipsis') {
            container.style.display = 'none'; // Close options box
            optionBoxActive = false; // Reset option box active state
            enableModal(); // Enable modal interactivity
        }
    });
});

function approveApplication(id) {
    event.preventDefault();
    updateApplicationStatus(id, 1); // 1 represents approved status
}

function rejectApplication(id) {
    event.preventDefault();
    updateApplicationStatus(id, 2); // 2 represents rejected status
}


// ajax dito

function updateApplicationStatus(id, status) {
    $.ajax({
        url: 'update_status.php', // Path to the PHP script handling the update
        type: 'POST',
        data: { id: id, status: status },
        success: function(response) {
            if (response.success) {
                // Update was successful, reload the page
                location.reload(true); // Reload the page, optionally passing true to force reloading from the server
            } else {
                // Update failed, display error message
                console.error('Error updating application status:', response.error);
            }
        },
        error: function(xhr, status, error) {
            // AJAX request encountered an error
            console.error('AJAX request error:', error);
        }
    });
}
 // Open the modal
 function openModal(id) {
    var modal = document.getElementById("myModal");
    if (modal) {
        // Set the ID attribute of the modal to match the ID retrieved from the server
        modal.setAttribute("data-id", id);
        // Display the modal
        modal.style.display = "block";
    }
}


        var ellipsisButtons = document.querySelectorAll('.ellipsis');
    ellipsisButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent event propagation
        });
    });

        // Close the modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // Close the modal when clicking outside the modal content
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>
    
</body>
</html>
