<?php

namespace Convert;

class Calculator {
    
    public function calculate($courses) {
        $old_cp = $new_cp = $sum_ch = 0;
    
        foreach($courses as $course) {
            $old_cp += ($this->old_scale($course[3]) * $course[2]);
            $new_cp += ($this->new_scale($course[3]) * $course[2]);
            $sum_ch += $course[2];
            $courses[$course[0]] = $course[3];
        }
        
        return [
            'courses' => $courses,
            'credit_hour' => $sum_ch,
            'old_credit_point' => $old_cp,
            'new_credit_point' => $new_cp,
            'old_gpa' => sprintf("%1.2f",(float)$old_cp / $sum_ch),
            'new_gpa' => sprintf("%1.2f",(float)$new_cp / $sum_ch),
        ];
    }
    
    protected function old_scale($char) {
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
    
    protected function new_scale($char) {
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

}