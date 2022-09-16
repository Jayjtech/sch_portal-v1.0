<?php
/**GRADES AND REMARKS */
                    if ($class == 'SSS-1' || $class == 'SSS-2' || $class == 'SSS-3') {
                        if ($total <= 39) {
                            $grade = "F9";
                            $remark = "Poor";
                            $color = "Red";
                        } else if ($total == 40 || $total == 41 || $total == 42 || $total == 43 || $total == 43 || $total == 44) {
                            $grade = "E8";
                            $remark = "Fair";
                            $color = "Red";
                        } else if ($total == 45 || $total == 46 || $total == 47 || $total == 48 || $total == 49) {
                            $grade = "D7";
                            $remark = "Pass";
                            $color = "Orange";
                        } else if ($total == 50 || $total == 51 || $total == 52 || $total == 53 || $total == 54 || $total == 55 || $total == 56 || $total == 57 || $total == 58 || $total == 59) {
                            $grade = "C6";
                            $remark = "Credit";
                            $color = "Yellow";
                        } else if (
                            $total == 60 || $total == 61 || $total == 62 || $total == 63 || $total == 64
                        ) {
                            $grade = "C5";
                            $remark = "Credit";
                            $color = "LightSeaGreen";
                        } else if ($total == 65 || $total == 66 || $total == 67 || $total == 68 || $total == 69) {
                            $grade = "C4";
                            $remark = "Credit";
                            $color = "LightSeaGreen";
                        } else if ($total == 70 || $total == 71 || $total == 72 || $total == 73 || $total == 74) {
                            $grade = "B3";
                            $remark = "V.Good";
                            $color = "Lime";
                        } else if ($total == 75 || $total == 76 || $total == 77 || $total == 78 || $total == 79) {
                            $grade = "B2";
                            $remark = "Distinction";
                            $color = "green";
                            $color = "LimeGreen";
                        } else if ($total >= 80) {
                            $grade = "A";
                            $remark = "Excellent";
                            $color = "darkGreen";
                        }
                    } else if ($class == 'JSS-1' || $class == 'JSS-2' || $class == 'JSS-3') {
                        if ($total <= 39) {
                            $grade = "E";
                            $remark = "Poor";
                            $color = "Red";
                        } else if (
                            $total == 40 || $total == 41 || $total == 42 || $total == 43 || $total == 43 || $total == 44 || $total == 45 || $total == 46 || $total == 47 || $total == 48 || $total == 49
                        ) {
                            $grade = "D";
                            $remark = "Average";
                            $color = "Orange";
                        } else if ($total == 50 || $total == 51 || $total == 52 || $total == 53 || $total == 54 || $total == 55 || $total == 56 || $total == 57 || $total == 58 || $total == 59) {
                            $grade = "C";
                            $remark = "Good";
                            $color = "Yellow";
                        } else if (
                            $total == 60 || $total == 61 || $total == 62 || $total == 63 || $total == 64 || $total == 65 || $total == 66 || $total == 67 || $total == 68 || $total == 69
                        ) {
                            $grade = "B";
                            $remark = "V.Good";
                            $color = "Green";
                        } else if ($total >= 70) {
                            $grade = "A";
                            $remark = "Excellent";
                            $color = "darkGreen";
                        } else {
                            $grade = "";
                            $remark = "";
                            $color = "";
                        }
                    }

                    /**END OF GRADES AND REMARKS */
?>