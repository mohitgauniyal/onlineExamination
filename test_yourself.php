<?php
function make_name($name) {
    $new_name = ucfirst(str_replace('_', ' ', $name));
    return $new_name;
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/w3.css">
        <link rel="stylesheet" href="styles/styles.css">

        <title></title>

        <style>
            .button {
                border-radius: 4px;
                background-color: blueviolet;
                border: none;
                color: #FFFFFF;
                text-align: center;
                font-size: 28px;
                padding: 20px;
                width: 200px;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }

            .button span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }

            .button span:after {
                content: '»';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -20px;
                transition: 0.5s;
            }

            .button:hover span {
                padding-right: 25px;                
            }

            .button:hover span:after {
                opacity: 1;
                right: 0;
            }

        </style>
    </head>
    <body>
        <nav>
            <?php require_once 'includes/guest/nav.inc.php'; ?>
        </nav>
        <section>
            <img  style="float:right; margin: 15px;" src="images/pic06.jpg" height="150px" width="150px" alt="Logo img.">
            <p style="margin: 15px;">Computer programming (often shortened to programming) is a process that leads from an original formulation of a computing problem to executable computer programs. Programming involves activities such as analysis, developing understanding, generating algorithms, verification of requirements of algorithms including their correctness and resources consumption, and implementation (commonly referred to as coding) of algorithms in a target programming language. Source code is written in one or more programming languages. The purpose of programming is to find a sequence of instructions that will automate performing a specific task or solving a given problem. The process of programming thus often requires expertise in many different subjects, including knowledge of the application domain, specialized algorithms and formal logic. Related tasks include testing, debugging, and maintaining the source code, implementation of the build system, and management of derived artifacts such as machine code of computer programs. These might be considered part of the programming process, but often the term software development is used for this larger process with the term programming, implementation, or coding reserved for the actual writing of source code. Software engineering combines engineering techniques with software development practices.</p>
            <h1 style="color:green;">Go and Test Yourselves&nbsp;-- </h1>
          </section>
        <footer>
            <?php require_once 'includes/guest/footer.inc.php'; ?>
        </footer>
    </body>
</html>






<!--

  <?php/*
            mysql_connect('localhost', 'root', '') or die("Can't connect to server");
            mysql_select_db('subjects') or die("Can't connect to server");
            $query = "show tables";
            $result = mysql_query($query);
            $loop_counter = 0;
            ?>
            <table>
                <tr>
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        $loop_counter++;
                        ?>
                    <div>
                        <?php $name = make_name($row[0]); ?>
                        <td><a href="roles/student/subject.php?subject=<?php echo $row[0]; ?>"><button class="button"><span><?php echo $name; ?></span></button></a></td>
                    <?php
                    if ($loop_counter == 4) {
                        echo '</tr>';
                        $loop_counter = 0;
                    }
                    echo '</div>';
                }
                ?>
                    
            </table>
        
-->*/