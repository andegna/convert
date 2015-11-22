<?php

    require_once('simplehtmldom/simple_html_dom.php');

    function old($char) {
        switch($char) {
            case 'A+': return 4.0;
            case 'A':  return 3.75;
            case 'A-': return 3.5;
            case 'B+': return 3.25;
            case 'B':  return 3;
            case 'C+': return 2.75;
            case 'C':  return 2.5;
            case 'D':  return 2.25;
            case 'E':  return 2;
            default:   return 0;
        }
    }

    function nw($char) {
        switch($char) {
            case 'A+':
            case 'A':
            case 'A-':
                return 4;
            case 'B+':
            case 'B':
                return 3.5;
            case 'C+': return 3;
            case 'C':  return 2.75;
            case 'D':  return 2.5;
            case 'E':  return 2;
            case 'F':  return 1;
            default:   return 0;
        }
    }

    function parse() {
        $courses = [];

        if(isset($_FILES['file'])) {
            $html = file_get_contents($_FILES['file']['tmp_name']);
            unlink($_FILES['file']['tmp_name']);

            $dom = str_get_html($html);
            foreach($dom->find('table.ob_gBody tr') as $courseNode) {
                $course = [];
                foreach($courseNode->find('.ob_gCc2') as $data) {
                    $course[] = $data->innertext();
                }
                if(count($course) > 0) {
                    $courses[$course[0]] = $course;
                }
            }
        }

        return $courses;
    }

    function calculate($courses) {
        $sum_ch = $n = $sum_cp = 0;
        foreach($courses as $course) {
            if(empty($course[3])) {
                continue;
            }
            $sum_cp += (old($course[3]) * $course[2]);
            $n += (nw($course[3]) * $course[2]);
            $sum_ch += $course[2];
        }

        return [
            'count' => count($courses),
            'sum_ch' => $sum_ch,
            'sum_old_cp' => $sum_cp,
            'sum_new_cp' => $n,
            'old_gpa' => sprintf("%1.2f",(float)$sum_cp / $sum_ch),
            'new_gpa' => sprintf("%1.2f",(float)$n / $sum_ch),
        ];
    }
