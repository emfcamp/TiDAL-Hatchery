<?php

declare(strict_types=1);

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use OpenApi\Annotations as OA;

/**
 * Class Kernel.
 *
 * @OA\Info(
 *   title="Hatchery by badge.team",
 *   version="0.2",
 *   description="Simple micropython software repository for Badges.",
 * @OA\Contact(
 *     name="Hatchery",
 *     url="https://docs.badge.team/hatchery",
 *     email="hatchery@badge.team"
 *   ),
 * @OA\License(
 *       name="MIT",
 *       url="https://opensource.org/licenses/MIT"
 *   )
 * )
 *
 * @OA\Parameter(
 *   parameter="badge",
 *   name="badge",
 *   in="path",
 *   required=true,
 * @OA\Schema(type="string", format="slug", example="sha2017")
 * )
 *
 * @OA\Response(
 *   response="html",
 *   description="Undocumented HTML response",
 * @OA\XmlContent()
 * ),
 * @OA\Response(
 *   response="undocumented",
 *   description="Undocumented JSON response",
 * @OA\JsonContent()
 * )
 *
 * @OA\Tag(
 *   name="Basket",
 *   description="Related to getting Projects for specific Badge models."
 * ),
 * @OA\Tag(
 *   name="Egg",
 *   description="Related to getting Eggs / Projects."
 * ),
 * @OA\Tag(
 *   name="External",
 *   description="External api proxies for convenience of apps."
 * )
 *
 * 　　　　　　 ＿＿
 * 　　　　　／＞　　フ
 * 　　　　　|  _　 _l  Not adding OA doc blocks makes kitty sad!!
 * 　 　　　／`ミ＿xノ
 * 　　 　 /　　　 　|
 * 　　　 /　 ヽ　　 ﾉ
 * 　 　 │　　|　|　|
 * 　／￣|　　 |　|　|
 * 　| (￣ヽ＿_ヽ_)__)
 * 　＼二つ
 *
 * @author annejan@badge.team
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        // \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Bepsvpt\SecureHeaders\SecureHeadersMiddleware::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\ShareMessagesFromSession::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'        => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        '2fa'        => \App\Http\Middleware\AuthenticatorMiddleware::class,
        'webauthn'   => \LaravelWebauthn\Http\Middleware\WebauthnMiddleware::class,
    ];
}
