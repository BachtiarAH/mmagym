<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\OtpRepository;
use LearnPhpMvc\repository\userRepository;
use LearnPhpMvc\Service\Service;

use function PHPUnit\Framework\isEmpty;

class AuthService extends Service
{
    protected userRepository $userRepo;
    protected OtpRepository $otpRepo;

    public function __construct($userRepo, $otpRepo)
    {
        $this->userRepo = $userRepo;
        $this->otpRepo = $otpRepo;
    }

    public function loginAdmin($request)
    {
        if (isset($request->email) && isset($request->password)) {
            $email = $request->email;
            $password = $request->password;
            $jsonResult = $this->userRepo->findByEmail($email);
            // var_dump($jsonResult == NULL);
            // var_dump($jsonResult);
            
            if (!($jsonResult==NULL)) {
                $emailResult = $jsonResult['body'][0]['email'];
                $passwordResult = $jsonResult['body'][0]['password'];
                $akses = $jsonResult['body'][0]['akses'];
                // echo $emailResult;
                if ($email == $emailResult) {

                    if ($password == $passwordResult) {
                        if ($akses == 2) {
                            return [
                                'status' => 'login success',
                                'body' => $jsonResult['body']
                            ];
                        } else if ($akses == 1) {
                            return [
                                'status' => 'login fail',
                                'message' => 'akun anda tidak memiliki akses'
                            ];
                        } elseif ($akses == 0) {
                            return [
                                'status' => 'login fail',
                                'message' => 'email belum di verifikasi'
                            ];
                        }
                    } else {
                        return [
                            'status' => 'login fail',
                            'message' => 'password salah'
                        ];
                    }
                }
            } else {
                return [
                    'status' => 'login fail',
                    'message' => 'email belum terdaftar'
                ];
            }
        } else {
            return [
                'status' => 'fail',
                'message' => 'format json kalah'
            ];
        }
    }

    public function login($request)
    {
        if (isset($request->email) && isset($request->password)) {
            $email = $request->email;
            $password = $request->password;
            $jsonResult = $this->userRepo->findByEmail($email);
            if ($jsonResult['respons_code'] == 200) {
                $emailResult = $jsonResult['body'][0]['email'];
                $passwordResult = $jsonResult['body'][0]['password'];
                $akses = $jsonResult['body'][0]['akses'];
                // echo $emailResult;
                if ($email == $emailResult && $password == $passwordResult && $akses != 0) {
                    return [
                        'status' => 'login success',
                        'body' => $jsonResult['body']
                    ];
                } else if (isEmpty($jsonResult)) {
                    return [
                        'status' => 'login fail',
                        'message' => 'email unregistered'
                    ];
                } else if ($akses == 0) {
                    return [
                        'status' => 'login fail',
                        'message' => 'email belum di verifikasi'
                    ];
                } {
                    return [
                        'status' => 'login fail',
                        'message' => 'password is wrong'
                    ];
                }
            }
        } else {
            return [
                'status' => 'fail',
                'message' => 'format json kalah'
            ];
        }
    }

    public function register($request)
    {
        if (isset($request->nama) && isset($request->password) && isset($request->email) && isset($request->alamat)) {


            $dataUser = $this->userRepo->findByEmail($request->email);
            if (count($dataUser['body']) > 0) {
                return ['status' => 'fail', 'message' => 'email sudah digunakan'];
            } else {
                $otp = rand(1000, 9999); //membuat random digit dari 1000 samapai 9999 yang akan selalu 4 digit angka
                $this->userRepo->addData($request->nama, $request->email, $request->password, $request->alamat, 0);
                $this->otpRepo->addOtp($request->email, $otp);

                $bodyMail = "
            <div>
                <p>jangan berikan code dibawah kepada siapapun</p>
                <h1>$otp</h1>
            </div>";

                $this->PhpMailerSend($request->email, 'Code OTP Amm Gym', $bodyMail);
                return ['status' => 'success', 'message' => 'otp berhasil dikirim'];
            }
        } else {
            return $this->FailResponse('format');
        }
    }

    public function verifyOtp($request)
    {
        if (isset($request->email) && isset($request->otp)) {
            $otpRepoResult = $this->otpRepo->findOtp($request->email, $request->otp);
            if (count($otpRepoResult['body']) > 0) {
                $this->userRepo->editAkses($request->email, 1);
                $this->otpRepo->deleteOtp($request->email);
                return [
                    'status' => 'success',
                    'message' => 'akun berhasil teregistrasi'
                ];
            } else {
                return [
                    'status' => 'fail',
                    'message' => 'code otp salah'
                ];
            }

            // return $otpRepoResult;
        } else {
            return $this->FailResponse('format');
        }
    }

    public function sendNewOtp($request)
    {
        if (isset($request->email)) {
            $otpRepoResult =  $this->otpRepo->findByEmail($request->email);
            if ($otpRepoResult['body'] > 0) {
                $otp = rand(1000, 9999);
                $this->otpRepo->updateOtp($request->email, $otp);
                $bodyMail = "
                    <div>
                        <p>jangan berikan code dibawah kepada siapapun</p>
                        <h1>$otp</h1>
                    </div>";

                $this->PhpMailerSend($request->email, 'Code OTP Amm Gym', $bodyMail);
                return ['status' => 'success', 'message' => 'otp berhasil dikirim'];
            } else {
                return ['status' => 'fail', 'message' => 'email tidak terdaftar'];
            }
        } else {
            return $this->FailResponse('format');
        }
    }

    public function sendOtpResetPassword($request)
    {
        if (isset($request->email)) {
            $userRepoResult = $this->userRepo->findByEmail($request->email);
            if ($userRepoResult['body'] > 0) {
                $otp = rand(1000, 9999); //membuat random digit dari 1000 samapai 9999 yang akan selalu 4 digit angka
                $this->otpRepo->addOtp($request->email, $otp);

                $bodyMail = "
                    <div>
                        <p>jangan berikan code dibawah kepada siapapun</p>
                        <h1>$otp</h1>
                    </div>";

                $this->PhpMailerSend($request->email, 'Code OTP Amm Gym', $bodyMail);
                return ['status' => 'success', 'message' => 'otp berhasil dikirim'];
            } else {
                return ['status' => 'fail', 'message' => 'email tidak terdaftar'];
            }
        } else {
            return $this->FailResponse('format');
        }
    }

    public function resetPassword($request)
    {
        if (isset($request->email) && isset($request->otp) && isset($request->newpassword)) {
            $OtpResult = $this->otpRepo->findOtp($request->email, $request->otp);
            if (count($OtpResult['body']) > 0) {
                $this->userRepo->editPassword($request->email, $request->newpassword);
                $this->otpRepo->deleteOtp($request->email);
                return ['status' => 'success', 'message' => 'password berhasil diperbarui'];
            } else {
                return ['status' => 'fail', 'message' => 'code otp salah'];
            }
        } else {
            return $this->FailResponse('format');
        }
    }

    public function cekOtp($request)
    {
        if (isset($request->email) && isset($request->otp)) {
            $resultOtp = $this->otpRepo->findOtp($request->email, $request->otp);
            if (count($resultOtp['body']) > 0) {
                return ['status' => 'success', 'message' => 'otp benar'];
            } else {
                return ['status' => 'fail', 'message' => 'otp salah'];
            }
        } else {
            return $this->FailResponse('format');
        }
    }
}
