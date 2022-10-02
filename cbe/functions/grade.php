<?php
/**GRADES AND REMARKS */
                    if ($class == 'SSS-1' || $class == 'SSS-2' || $class == 'SSS-3') {
                        if (round($total) <= 39) {
                            $grade = "F9";
                            $remark = "Poor";
                            $color = "Red";
                        } else if (round($total) == 40 || round($total) == 41 || round($total) == 42 || round($total) == 43 || round($total) == 43 || round($total) == 44) {
                            $grade = "E8";
                            $remark = "Fair";
                            $color = "Red";
                        } else if (round($total) == 45 || round($total) == 46 || round($total) == 47 || round($total) == 48 || round($total) == 49) {
                            $grade = "D7";
                            $remark = "Pass";
                            $color = "Orange";
                        } else if (round($total) == 50 || round($total) == 51 || round($total) == 52 || round($total) == 53 || round($total) == 54 || round($total) == 55 || round($total) == 56 || round($total) == 57 || round($total) == 58 || round($total) == 59) {
                            $grade = "C6";
                            $remark = "Credit";
                            $color = "Yellow";
                        } else if (
                            round($total) == 60 || round($total) == 61 || round($total) == 62 || round($total) == 63 || round($total) == 64
                        ) {
                            $grade = "C5";
                            $remark = "Credit";
                            $color = "LightSeaGreen";
                        } else if (round($total) == 65 || round($total) == 66 || round($total) == 67 || round($total) == 68 || round($total) == 69) {
                            $grade = "C4";
                            $remark = "Credit";
                            $color = "LightSeaGreen";
                        } else if (round($total) == 70 || round($total) == 71 || round($total) == 72 || round($total) == 73 || round($total) == 74) {
                            $grade = "B3";
                            $remark = "V.Good";
                            $color = "Lime";
                        } else if (round($total) == 75 || round($total) == 76 || round($total) == 77 || round($total) == 78 || round($total) == 79) {
                            $grade = "B2";
                            $remark = "Distinction";
                            $color = "green";
                            $color = "LimeGreen";
                        } else if (round($total) >= 80) {
                            $grade = "A";
                            $remark = "Excellent";
                            $color = "darkGreen";
                        }
                    } else if ($class == 'JSS-1' || $class == 'JSS-2' || $class == 'JSS-3') {
                        if (round($total) <= 39) {
                            $grade = "E";
                            $remark = "Poor";
                            $color = "Red";
                        } else if (
                            round($total) == 40 || round($total) == 41 || round($total) == 42 || round($total) == 43 || round($total) == 43 || round($total) == 44 || round($total) == 45 || round($total) == 46 || round($total) == 47 || round($total) == 48 || round($total) == 49
                        ) {
                            $grade = "D";
                            $remark = "Average";
                            $color = "Orange";
                        } else if (round($total) == 50 || round($total) == 51 || round($total) == 52 || round($total) == 53 || round($total) == 54 || round($total) == 55 || round($total) == 56 || round($total) == 57 || round($total) == 58 || round($total) == 59) {
                            $grade = "C";
                            $remark = "Good";
                            $color = "Yellow";
                        } else if (
                            round($total) == 60 || round($total) == 61 || round($total) == 62 || round($total) == 63 || round($total) == 64 || round($total) == 65 || round($total) == 66 || round($total) == 67 || round($total) == 68 || round($total) == 69
                        ) {
                            $grade = "B";
                            $remark = "V.Good";
                            $color = "Green";
                        } else if (round($total) >= 70) {
                            $grade = "A";
                            $remark = "Excellent";
                            $color = "darkGreen";
                        } else {
                            $grade = "";
                            $remark = "";
                            $color = "";
                        }
                    }


                    /**Type 2 template */
                    if ($class == 'SSS-1' || $class == 'SSS-2' || $class == 'SSS-3') {
                        if (round($average) <= 39) {
                            $grade_b = "F9";
                            $remark_b = "Poor";
                            $color = "Red";
                        } else if (round($average) == 40 || round($average) == 41 || round($average) == 42 || round($average) == 43 || round($average) == 43 || round($average) == 44) {
                            $grade_b = "E8";
                            $remark_b = "Fair";
                            $color = "Red";
                        } else if (round($average) == 45 || round($average) == 46 || round($average) == 47 || round($average) == 48 || round($average) == 49) {
                            $grade_b = "D7";
                            $remark_b = "Pass";
                            $color = "Orange";
                        } else if (round($average) == 50 || round($average) == 51 || round($average) == 52 || round($average) == 53 || round($average) == 54 || round($average) == 55 || round($average) == 56 || round($average) == 57 || round($average) == 58 || round($average) == 59) {
                            $grade_b = "C6";
                            $remark_b = "Credit";
                            $color = "Yellow";
                        } else if (
                            round($average) == 60 || round($average) == 61 || round($average) == 62 || round($average) == 63 || round($average) == 64
                        ) {
                            $grade_b = "C5";
                            $remark_b = "Credit";
                            $color = "LightSeaGreen";
                        } else if (round($average) == 65 || round($average) == 66 || round($average) == 67 || round($average) == 68 || round($average) == 69) {
                            $grade_b = "C4";
                            $remark_b = "Credit";
                            $color = "LightSeaGreen";
                        } else if (round($average) == 70 || round($average) == 71 || round($average) == 72 || round($average) == 73 || round($average) == 74) {
                            $grade_b = "B3";
                            $remark_b = "V.Good";
                            $color = "Lime";
                        } else if (round($average) == 75 || round($average) == 76 || round($average) == 77 || round($average) == 78 || round($average) == 79) {
                            $grade_b = "B2";
                            $remark_b = "Distinction";
                            $color = "green";
                            $color = "LimeGreen";
                        } else if (round($average) >= 80) {
                            $grade_b = "A";
                            $remark_b = "Excellent";
                            $color = "darkGreen";
                        }
                    } else if ($class == 'JSS-1' || $class == 'JSS-2' || $class == 'JSS-3') {
                        if (round($average) <= 39) {
                            $grade_b = "E";
                            $remark_b = "Poor";
                            $color = "Red";
                        } else if (
                            round($average) == 40 || round($average) == 41 || round($average) == 42 || round($average) == 43 || round($average) == 43 || round($average) == 44 || round($average) == 45 || round($average) == 46 || round($average) == 47 || round($average) == 48 || round($average) == 49
                        ) {
                            $grade_b = "D";
                            $remark_b = "Average";
                            $color = "Orange";
                        } else if (round($average) == 50 || round($average) == 51 || round($average) == 52 || round($average) == 53 || round($average) == 54 || round($average) == 55 || round($average) == 56 || round($average) == 57 || round($average) == 58 || round($average) == 59) {
                            $grade_b = "C";
                            $remark_b = "Good";
                            $color = "Yellow";
                        } else if (
                            round($average) == 60 || round($average) == 61 || round($average) == 62 || round($average) == 63 || round($average) == 64 || round($average) == 65 || round($average) == 66 || round($average) == 67 || round($average) == 68 || round($average) == 69
                        ) {
                            $grade_b = "B";
                            $remark_b = "V.Good";
                            $color = "Green";
                        } else if (round($average) >= 70) {
                            $grade_b = "A";
                            $remark_b = "Excellent";
                            $color = "darkGreen";
                        } else {
                            $grade_b = "";
                            $remark_b = "";
                            $color = "";
                        }
                    }

                    /**END OF GRADES AND REMARKS */
?>