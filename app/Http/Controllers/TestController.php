<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alphabet;
use App\Digit;
use DB;
use App\SpecialChar;
use App\Email;
use App\Domain;

class TestController extends Controller
{
    public function email (Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $flag = true;
        $email = str_split($request->email);
        $atFlag = false;
        $dotFlag = null;

        try {
            for ($i = 0; $i < sizeof($email); $i++) {
                if (!$atFlag) {
                    if ($i == 0) {
                        if (Alphabet::where('value', $email[$i])->first() == null) {
                            $flag = false;
                        }
                    } elseif ($email[$i] == '@') {
                        $atFlag = true;
                    } else {
                        if (Alphabet::where('value', $email[$i])->first() == null && Digit::where('value', $email[$i])->first() == null) {
                            if (SpecialChar::where('value', $email[$i])->where('type', 'email')->first() != null) {
                                if (Alphabet::where('value', $email[$i + 1])->first() == null && Digit::where('value', $email[$i + 1])->first() == null) {
                                    $flag = false;
                                }
                            } else {
                                $flag = false;
                            }
                        }
                    }
                } else {
                    if (Alphabet::where('value', $email[$i])->first() == null && Digit::where('value', $email[$i])->first() == null) {
                        if ($email[$i] == '.') {
                            $i++;
                            $tld = '';
                            for (; $i < sizeof($email); $i++) {
                                $tld .= $email[$i];
                            }

                            if (DB::table('t_l_ds')->where('value', $tld)->first() == null) {
                                $flag = false;
                            }

                            break;
                        }
                    }
                }
    
                if (!$flag) {
                    break;
                }
            }
        } catch (\Exception $e) {
            $flag = false;
        }

        $email = new Email;
        $email->value = $request->email;
        $email->validity = $flag;
        $email->save();

        return back();
    }

    public function domain (Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
        ]);

        $flag = true;
        $domain = str_split($request->domain);
        $i = sizeof($domain) - 1;
        $tld = '';

        for (; $i >= 0; $i--) {
            if ($domain[$i] == '.') {
                break;
            } else {
                $tld = $domain[$i].$tld;
            }
        }

        if (DB::table('t_l_ds')->where('value', $tld)->first() == null) {
            $flag = false;
        }

        if ($flag) {
            try {
                for (; $i >= 0; $i--) {
                    if (Alphabet::where('value', $domain[$i])->first() == null && Digit::where('value', $domain[$i])->first() == null) {
                        if (SpecialChar::where('value', $domain[$i])->where('type', 'web')->first() != null) {
                            if (Alphabet::where('value', $domain[$i - 1])->first() == null && Digit::where('value', $domain[$i - 1])->first() == null) {
                                $flag = false;
                            }
                        } else {
                            $flag = false;
                        }
                    }
                }
            } catch (\Exception $e) {
                $flag = false;
            }
        }

        $domain = new Domain;
        $domain->value = $request->domain;
        $domain->validity = $flag;
        $domain->save();

        return back();
    }
}
