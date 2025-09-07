<?php
// Initialize variables
$name = $email = $password = $gender = $mobile = $address = $dob = $course = $college = $github = $linkedin = $feedback = "";
$hobby = "";
$skills = "";

$successMsg = "";

// Error variables
$nameErr = $emailErr = $passwordErr = $genderErr = $mobileErr = $addressErr = $dobErr = $courseErr = $collegeErr = $githubErr = $linkedinErr = $hobbyErr = $skillsErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = $_POST["name"];
        $hasNumber = false;
        for ($i = 0; $i < strlen($name); $i++) {
            if ($name[$i] >= '0' && $name[$i] <= '9') {
                $hasNumber = true;
                break;
            }
        }
        if ($hasNumber) {
            $nameErr = "Numbers not allowed in name";
        }
    }

    // Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        if (strpos($email, "@") === false || strpos($email, ".") === false) {
            $emailErr = "Invalid email format";
        }
    }

    // Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } elseif (strlen($_POST["password"]) < 6) {
        $passwordErr = "Password must be at least 6 characters";
    } else {
        $password = $_POST["password"];
    }

    // Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Please select gender";
    } else {
        $gender = $_POST["gender"];
    }

    // Mobile
    if (empty($_POST["mobile"])) {
        $mobileErr = "Mobile number is required";
    } else {
        $mobile = $_POST["mobile"];
        $allDigits = true;
        for ($i = 0; $i < strlen($mobile); $i++) {
            if (!($mobile[$i] >= '0' && $mobile[$i] <= '9')) {
                $allDigits = false;
                break;
            }
        }
        if (!$allDigits || strlen($mobile) != 10) {
            $mobileErr = "Enter a valid 10-digit mobile number";
        }
    }

    // Address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = $_POST["address"];
    }

    // Date of Birth
    if (empty($_POST["dob"])) {
        $dobErr = "Date of Birth is required";
    } else {
        $dob = $_POST["dob"];
    }

    // Course
    if (empty($_POST["course"])) {
        $courseErr = "Course is required";
    } else {
        $course = $_POST["course"];
    }

    // College
    if (empty($_POST["college"])) {
        $collegeErr = "College is required";
    } else {
        $college = $_POST["college"];
    }

   
// GitHub validation
if (empty($_POST["github"])) {
    $githubErr = "GitHub link is required";
} else {
    $github = $_POST["github"];
    if (strpos($github, "http") !== 0) {
        $githubErr = "Enter a valid GitHub link";
    }
}

// LinkedIn validation
if (empty($_POST["linkedin"])) {
    $linkedinErr = "LinkedIn link is required";
} else {
    $linkedin = $_POST["linkedin"];
    if (strpos($linkedin, "http") !== 0) {
        $linkedinErr = "Enter a valid LinkedIn link";
    }
}



// Hobby
if (empty($_POST["hobby"])) {
    $hobbyErr = "Please select a hobby";
} else {
    $hobby = $_POST["hobby"];
}

if (empty($_POST["skills"])) {
    $skillsErr = "Please select a skill";
} else {
    $skills = $_POST["skills"];
}


    // Feedback
    if (!empty($_POST["feedback"])) {
        $feedback = $_POST["feedback"];
    }

    // Save if no errors
    if (
    $nameErr=="" && $emailErr=="" && $passwordErr=="" && $genderErr=="" &&
    $mobileErr=="" && $addressErr=="" && $dobErr=="" && $courseErr=="" &&
    $collegeErr=="" && $githubErr=="" && $linkedinErr=="" && $hobbyErr=="" && $skillsErr==""
) {


        $data = "Name: $name\nEmail: $email\nPassword: $password\nGender: $gender\nMobile: $mobile\nAddress: $address\nDOB: $dob\nCourse: $course\nCollege: $college\nGitHub: $github\nLinkedIn: $linkedin\nHobbies: $hobby\nSkills: $skills\nFeedback: $feedback\n";
        $data .= "----------------------------------------\n";

        $file = fopen("submissions.txt", "a");
        fwrite($file, $data);
        fclose($file);

        // Simple form submit box
        $successMsg = "<div class='success-box'>Form submitted successfully ✅</div>";


        // Clear form values
        $_POST = array();
        $name = $email = $password = $gender = $mobile = $address = $dob = $course = $college = $github = $linkedin = $feedback = "";
$hobby = "";
$skills = "";


    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Student Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4" style="max-width:600px;margin:auto;">
        <h2 class="mb-4 text-center">Student Form</h2>

        <?php if ($successMsg != "") echo $successMsg; ?>

        <form method="post" action="">
            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <small class="text-danger"><?php echo $nameErr; ?></small>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <small class="text-danger"><?php echo $emailErr; ?></small>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
                <small class="text-danger"><?php echo $passwordErr; ?></small>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select">
                    <option value="">Select</option>
                    <option value="Male" <?php if($gender=="Male") echo "selected";?>>Male</option>
                    <option value="Female" <?php if($gender=="Female") echo "selected";?>>Female</option>
                </select>
                <small class="text-danger"><?php echo $genderErr; ?></small>
            </div>

            <!-- Mobile -->
            <div class="mb-3">
                <label class="form-label">Mobile</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo $mobile; ?>">
                <small class="text-danger"><?php echo $mobileErr; ?></small>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                <small class="text-danger"><?php echo $addressErr; ?></small>
            </div>

            <!-- DOB -->
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>">
                <small class="text-danger"><?php echo $dobErr; ?></small>
            </div>

            <!-- Course -->
            <div class="mb-3">
                <label class="form-label">Course</label>
                <input type="text" name="course" class="form-control" value="<?php echo $course; ?>">
                <small class="text-danger"><?php echo $courseErr; ?></small>
            </div>

            <!-- College -->
            <div class="mb-3">
                <label class="form-label">College</label>
                <input type="text" name="college" class="form-control" value="<?php echo $college; ?>">
                <small class="text-danger"><?php echo $collegeErr; ?></small>
            </div>

            <!-- GitHub -->
<div class="mb-3">
    <label class="form-label">GitHub</label>
    <input type="text" name="github" class="form-control" value="<?php echo $github; ?>">
    <small class="text-danger"><?php echo $githubErr; ?></small>
</div>

<!-- LinkedIn -->
<div class="mb-3">
    <label class="form-label">LinkedIn</label>
    <input type="text" name="linkedin" class="form-control" value="<?php echo $linkedin; ?>">
    <small class="text-danger"><?php echo $linkedinErr; ?></small>
</div>


            <!-- Hobbies -->
<div class="mb-3">
    <label class="form-label">Hobbies</label><br>
    <input type="radio" name="hobby" value="Reading" <?php if($hobby=="Reading") echo "checked"; ?>> Reading<br>
    <input type="radio" name="hobby" value="Sports" <?php if($hobby=="Sports") echo "checked"; ?>> Sports<br>
    <input type="radio" name="hobby" value="Music" <?php if($hobby=="Music") echo "checked"; ?>> Music<br>
    <input type="radio" name="hobby" value="Traveling" <?php if($hobby=="Traveling") echo "checked"; ?>> Traveling<br>
    <small class="text-danger"><?php echo $hobbyErr; ?></small>
</div>


<div class="mb-3">
    <label class="form-label">Skills</label><br>
    <input type="radio" name="skills" value="C" <?php if($skills=="C") echo "checked"; ?>> C<br>
    <input type="radio" name="skills" value="C++" <?php if($skills=="C++") echo "checked"; ?>> C++<br>
    <input type="radio" name="skills" value="Java" <?php if($skills=="Java") echo "checked"; ?>> Java<br>
    <input type="radio" name="skills" value="Python" <?php if($skills=="Python") echo "checked"; ?>> Python<br>
    <input type="radio" name="skills" value="PHP" <?php if($skills=="PHP") echo "checked"; ?>> PHP<br>
    <small class="text-danger"><?php echo $skillsErr; ?></small>
</div>



            <!-- Feedback -->
            <div class="mb-3">
                <label class="form-label">Feedback</label>
                <textarea name="feedback" class="form-control"><?php echo $feedback; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
