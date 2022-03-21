<?php

// To display page name dynamicly
function getTitle()
{
    global $pageTitle;
    return isset($pageTitle) && !empty($pageTitle) ? $pageTitle . ' | Trilog' : 'Trilog';
}

// Filter form data to string
function filterStr($val)
{
    return trim(filter_var($val, FILTER_SANITIZE_SPECIAL_CHARS));
}

// Filter form data to email
function filterEmail($val)
{
    return trim(filter_var($val, FILTER_SANITIZE_EMAIL));
}

// To check if this value is a valid email
function isEmail($val)
{
    return trim(filter_var($val, FILTER_VALIDATE_EMAIL));
}

// To encrypt password
function enc_pass($pass)
{
    return trim(MD5($pass));
}

// To redirect to other page
function redirect($page, $delay = null, $script = null)
{
    if ($script == null) {
        if ($delay !== null) {
            header("refresh: $delay; url= $page");
        } else {
            header("location: $page");
        }
    } else {
        echo "<script>location = '$page'</script>";
    }
}

// Check if values is valid
function checkValidate($params)
{

    $val             = isset($params['val']) ? $params['val'] : null;
    $otherVal        = isset($params['otherVal']) ? $params['otherVal'] : null;
    $msg             = isset($params['msg']) ? $params['msg'] : null;
    $check           = isset($params['check']) ? $params['check'] : null;
    $min             = isset($params['min']) ? $params['min'] : null;
    $max             = isset($params['max']) ? $params['max'] : null;
    $type            = isset($params['type']) ? $params['type'] : null;
    $validExtensions = isset($params['validExtensions']) ? $params['validExtensions'] : null;
    $validExtensions = isset($params['validExtensions']) ? $params['validExtensions'] : null;
    $validExtensions = isset($params['validExtensions']) ? $params['validExtensions'] : null;
    $fileSize = isset($params['fileSize']) ? $params['fileSize'] : null;

    $errorsContainer = [];
    global $errorsContainer;

    if ($check == "empty") {
        if (empty($val)) {
            $errorsContainer[] = $msg;
        }
    }

    if ($check == "email") {
        if (isEmail($val) == false) {
            $errorsContainer[] = $msg;
        }
    }

    if ($check == "min" && $min !== null) {
        if (mb_strlen($val, "utf-8") < $min) {
            $errorsContainer[] = $msg;
        }
    }

    if ($check == "max" && $max !== null) {
        if (mb_strlen($val, "utf-8") > $max) {
            $errorsContainer[] = $msg;
        }
    }

    if ($check == "in_data") {
        if (!in_array($val, ["male", "female"])) {
            $errorsContainer[] = $msg;
        }
    }

    if ($check == "comparison") {
        if ($val !== $otherVal) {
            $errorsContainer[] = $msg;
        }
    }

    if ($check == "file") {
        if (!in_array($type, $validExtensions)) {
            $errorsContainer[] = $msg;
        }
    }

    if ($check == "fileSize") {
        if ($fileSize > $max) {
            $errorsContainer[] = $msg;
        }
    }

    return !empty($errorsContainer) ? $errorsContainer : [];
}

// Select one column
function selectColumn($column, $table, $where, $val)
{
    global $conn;
    $stmt = $conn->prepare("SELECT $column FROM $table $where");
    $stmt->execute($val);
    return $stmt->fetchColumn();
}

// Select one row
function selectRow($query, $bind = [])
{
    global $conn;
    $stmt = $conn->prepare("$query");
    $stmt->execute($bind);
    return $stmt->fetch();
}

// Select all rows
function selectRows($query, $bind = [])
{
    global $conn;
    $stmt = $conn->prepare("$query");
    $stmt->execute($bind);
    return $stmt->fetchAll();
}

// Check if this column exist
function insert($table, $values, $bind)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO $table $values");
    $stmt->execute($bind);
    return $stmt->rowCount();
}

// Check if this column exist
function update($table, $columns, $where, $bind)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE $table SET $columns $where");
    $stmt->execute($bind);
    return $stmt->rowCount();
}

// Use to delete rows
function deleteRows($table, $where, $bind)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM $table $where");
    $stmt->execute($bind);
    return $stmt->rowCount();
}

// Custom toastr to display messages
function toastr($desc, $type = "error")
{
    echo "
        <script>
            toastr.$type(`$desc`);
        </script>
    ";
}

// To generate random code
function generateRandomCode($length = 60)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Display time ago | Like this : 3min ago, 36s ago, 3 months...
function timeAgo($time)
{
    $seconds    = time() - $time;
    $minutes    = round($seconds / 60);
    $hours      = round($seconds / (60 * 60));
    $days       = round($seconds / ((60 * 60) * 24));
    $week       = round($seconds / (((60 * 60) * 24) * 7));
    $month      = round($seconds / (((60 * 60) * 24) * 7) * 4.3);
    $year       = round($seconds / ((((60 * 60) * 24) * 7) * 4.3) * 12);

    if ($seconds <= 60) {
        if ($seconds === 0) {
            $ago = 'just now';
        } else {
            $ago = $seconds . 's ago';
        }
    } elseif ($minutes <= 60) {
        if ($minutes == 1) {
            $ago = 'one min ago';
        } else {
            $ago = $minutes . ' min ago';
        }
    } elseif ($hours <= 24) {
        if ($hours == 1) {
            $ago = 'one hour ago';
        } else {
            $ago =  $hours . ' hours ';
        }
    } elseif ($days <= 7) {
        if ($days == 1) {
            $ago = 'yesterday';
        } else {
            $ago = $days . ' days ';
        }
    } elseif ($week <= 4.3) {
        $ago = $week . ' Weeks ';
    } elseif ($month <= 12) {
        $ago = $month . ' months ';
    } elseif ($year > 12) {
        $ago = $year . ' years ';
    }

    return $ago;
}

// Use to display avatar for users
function showAvatar($name)
{
    return !empty($name) ? 'includes/uploads/avatar/' . $name : 'includes/uploads/avatar/default-avatar.jpg';
}
