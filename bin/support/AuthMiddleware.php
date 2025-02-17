<?php
namespace Support;
use App\Models\LoginAct;
use App\Models\User;

class AuthMiddleware
{
    protected $userId;

    public function __construct() {
        // Pastikan kita mendapatkan user ID dari session
        if (\Support\Session::has('user')) {
            $this->userId = \Support\Session::user()->users_id;

            // Simpan user ID ke dalam session terpisah jika belum disimpan
            if (!isset($_SESSION['user_id_persistent'])) {
                $_SESSION['user_id_persistent'] = $this->userId;
            }
        } else {
            // Jika session user habis, gunakan user ID dari session persistent
            $this->userId = $_SESSION['user_id_persistent'] ?? null;
        }
    }

    public function handle() {
        // Pengecekan login
        if (!$this->checkLogin()) {
            $this->logLogoutActivity($this->userId);
            return redirect('/login');
        }
    }

    public function checkLogin() {
        if (!\Support\Session::has('user')) {
            $this->logLogoutActivity($this->userId);
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                http_response_code(401); // Unauthorized
                exit;
            } else {
                return redirect('/login');
            }
        }

        $session_lifetime = env('SESSION_LIFETIME')*60;
        $current_time = time();
        
        if (isset($_SESSION['login_time']) && ($current_time - $_SESSION['login_time']) > $session_lifetime) {
            $this->logLogoutActivity($this->userId);
            session_unset();
            session_destroy();
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                http_response_code(401); // Unauthorized
                exit;
            } else {
                return redirect('/login');
            }
        }
        
        $_SESSION['login_time'] = $current_time;
        return true;
    }

    private function logLogoutActivity($userId) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown IP';
        $hostname = gethostbyaddr($ip);

        LoginAct::create([
            'users_id' => $userId,
            'login_time' => Date::Now(),
            'ip_address' => $ip,
            'hostname' => $hostname,
            'status' => 'logout',
        ]);
    }
}
?>
