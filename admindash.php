<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Include the database connection
$servername = "localhost"; // Change if hosted remotely
$username = "root"; // Use your MySQL username
$password = "Annaneema"; // Use your MySQL password
$dbname = "bursary_applications";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch applicants data from the database
$applicants = [];
$result = $conn->query("SELECT * FROM applicants");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $applicants[] = $row;
    }
}

// Fetch siblings data from the database
$siblings = [];
foreach ($applicants as $applicant) {
    $applicant_id = $applicant['id'];
    $sibling_result = $conn->query("SELECT * FROM siblings WHERE applicant_id = $applicant_id");
    while ($sibling = $sibling_result->fetch_assoc()) {
        $siblings[$applicant_id][] = $sibling;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
       
        
        <h2>Applicants List</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Admission Number</th>
                <th>Identity Number</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>NEMIS Number</th>
                <th>Constituency</th>
                <th>Ward</th>
                <th>Location</th>
                <th>Sub Location</th>
                <th>Village</th>
                <th>Institution Name</th>
                <th>Institution Code</th>
                <th>Mode of Study</th>
                <th>Class</th>
                <th>Year of Completion</th>
                <th>Family Status</th>
                <th>Father Name</th>
                <th>Mother Name</th>
                <th>Father Occupation</th>
                <th>Mother Occupation</th>
                <th>Father Income</th>
                <th>Mother Income</th>
                <th>Father Other Income</th>
                <th>Mother Other Income</th>
                <th>Father Employed</th>
                <th>Mother Employed</th>
                <th>Father Phone</th>
                <th>Mother Phone</th>
                <th>Reason for Bursary</th>
                <th>Physical Impairment</th>
                <th>Other Disability</th>
                <th>Disability Description</th>
                <th>Parent Disability</th>
                <th>Parent Disability Description</th>
               
                <th>Secondary School Funding</th>
                
                
                <th>Bursary Amount</th>
                <th>Supporting Documents</th>
                
            </tr>
            <?php foreach ($applicants as $applicant): ?>
                <tr>
                    <td><?php echo htmlspecialchars($applicant['name']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['admission_number']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['identity_number']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['phone']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['gender']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['dob']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['nemis']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['constituency']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['ward']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['location']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['sub_location']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['village']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['institution_name']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['institution_code']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['mode_of_study']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['class']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['year_of_completion']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['family_status']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['father_name']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['mother_name']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['father_occupation']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['mother_occupation']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['father_income']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['mother_income']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['father_other_income']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['mother_other_income']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['father_employed']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['mother_employed']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['father_phone']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['mother_phone']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['reason_for_bursary']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['physical_impairment']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['other_disability']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['disability_description']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['parent_disability']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['parent_disability_description']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['secondary_school_funding']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['bursary_amount']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['supporting_documents']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Siblings Details</h2>
        <table>
            <tr>
                <th>Applicant Name</th>
                <th>Sibling Name</th>
                <th>Relationship</th>
                <th>School</th>
                <th>Class</th>
                <th>Total Fees</th>
                <th>Outstanding Balance</th>
            </tr>
            <?php foreach ($applicants as $applicant): ?>
                <?php $applicant_id = $applicant['id']; ?>
                <?php if (isset($siblings[$applicant_id])): ?>
                    <?php foreach ($siblings[$applicant_id] as $sibling): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($applicant['name']); ?></td>
                            <td><?php echo htmlspecialchars($sibling['sibling_name']); ?></td>
                            <td><?php echo htmlspecialchars($sibling['relationship']); ?></td>
                            <td><?php echo htmlspecialchars($sibling['school']); ?></td>
                            <td><?php echo htmlspecialchars($sibling['class']); ?></td>
                            <td><?php echo htmlspecialchars($sibling['total_fees']); ?></td>
                            <td><?php echo htmlspecialchars($sibling['outstanding_balance']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <a href="admin_logout.php">Logout</a>
    </div>
</body>
</html>

