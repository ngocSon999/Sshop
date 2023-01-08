<?php //f3020a790f325fa1288b81dbda42c0a6
/** @noinspection all */

namespace App\Models {

    use Database\Factories\UserFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\MorphToMany;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Notifications\DatabaseNotificationCollection;
    use Illuminate\Support\Carbon;
    use Laravel\Sanctum\PersonalAccessToken;
    use LaravelIdea\Helper\App\Models\_IH_Category_C;
    use LaravelIdea\Helper\App\Models\_IH_Category_QB;
    use LaravelIdea\Helper\App\Models\_IH_Menu_C;
    use LaravelIdea\Helper\App\Models\_IH_Menu_QB;
    use LaravelIdea\Helper\App\Models\_IH_Permission_C;
    use LaravelIdea\Helper\App\Models\_IH_Permission_QB;
    use LaravelIdea\Helper\App\Models\_IH_ProductImage_C;
    use LaravelIdea\Helper\App\Models\_IH_ProductImage_QB;
    use LaravelIdea\Helper\App\Models\_IH_ProductTag_C;
    use LaravelIdea\Helper\App\Models\_IH_ProductTag_QB;
    use LaravelIdea\Helper\App\Models\_IH_Product_C;
    use LaravelIdea\Helper\App\Models\_IH_Product_QB;
    use LaravelIdea\Helper\App\Models\_IH_Role_C;
    use LaravelIdea\Helper\App\Models\_IH_Role_QB;
    use LaravelIdea\Helper\App\Models\_IH_Setting_C;
    use LaravelIdea\Helper\App\Models\_IH_Setting_QB;
    use LaravelIdea\Helper\App\Models\_IH_Slider_C;
    use LaravelIdea\Helper\App\Models\_IH_Slider_QB;
    use LaravelIdea\Helper\App\Models\_IH_Tag_C;
    use LaravelIdea\Helper\App\Models\_IH_Tag_QB;
    use LaravelIdea\Helper\App\Models\_IH_User_C;
    use LaravelIdea\Helper\App\Models\_IH_User_QB;
    use LaravelIdea\Helper\Illuminate\Notifications\_IH_DatabaseNotification_QB;
    use LaravelIdea\Helper\Laravel\Sanctum\_IH_PersonalAccessToken_C;
    use LaravelIdea\Helper\Laravel\Sanctum\_IH_PersonalAccessToken_QB;

    /**
     * @property int $id
     * @property string $name
     * @property int $parent_id
     * @property string $slug
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Carbon|null $deleted_at
     * @method static _IH_Category_QB onWriteConnection()
     * @method _IH_Category_QB newQuery()
     * @method static _IH_Category_QB on(null|string $connection = null)
     * @method static _IH_Category_QB query()
     * @method static _IH_Category_QB with(array|string $relations)
     * @method _IH_Category_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Category_C|Category[] all()
     * @foreignLinks id,\App\Models\Product,category_id
     * @mixin _IH_Category_QB
     */
    class Category extends Model {}

    /**
     * @property int $id
     * @property string $name
     * @property int $parent_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string $slug
     * @property Carbon|null $deleted_at
     * @method static _IH_Menu_QB onWriteConnection()
     * @method _IH_Menu_QB newQuery()
     * @method static _IH_Menu_QB on(null|string $connection = null)
     * @method static _IH_Menu_QB query()
     * @method static _IH_Menu_QB with(array|string $relations)
     * @method _IH_Menu_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Menu_C|Menu[] all()
     * @mixin _IH_Menu_QB
     */
    class Menu extends Model {}

    /**
     * @property int $id
     * @property string $name
     * @property string $display_name
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property int $parent_id
     * @property string $key_code
     * @property _IH_Permission_C|Permission[] $rolesChildrent
     * @property-read int $roles_childrent_count
     * @method HasMany|_IH_Permission_QB rolesChildrent()
     * @method static _IH_Permission_QB onWriteConnection()
     * @method _IH_Permission_QB newQuery()
     * @method static _IH_Permission_QB on(null|string $connection = null)
     * @method static _IH_Permission_QB query()
     * @method static _IH_Permission_QB with(array|string $relations)
     * @method _IH_Permission_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Permission_C|Permission[] all()
     * @foreignLinks
     * @mixin _IH_Permission_QB
     */
    class Permission extends Model {}

    /**
     * @property int $id
     * @property string $name
     * @property string $price
     * @property string $feature_image_path
     * @property string $content
     * @property int $user_id
     * @property int $category_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string $feature_image_name
     * @property Carbon|null $deleted_at
     * @property Category $category
     * @method BelongsTo|_IH_Category_QB category()
     * @property _IH_ProductImage_C|ProductImage[] $images
     * @property-read int $images_count
     * @method HasMany|_IH_ProductImage_QB images()
     * @property _IH_ProductImage_C|ProductImage[] $productImage
     * @property-read int $product_image_count
     * @method HasMany|_IH_ProductImage_QB productImage()
     * @property _IH_Tag_C|Tag[] $tags
     * @property-read int $tags_count
     * @method BelongsToMany|_IH_Tag_QB tags()
     * @method static _IH_Product_QB onWriteConnection()
     * @method _IH_Product_QB newQuery()
     * @method static _IH_Product_QB on(null|string $connection = null)
     * @method static _IH_Product_QB query()
     * @method static _IH_Product_QB with(array|string $relations)
     * @method _IH_Product_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Product_C|Product[] all()
     * @ownLinks user_id,\App\Models\User,id|category_id,\App\Models\Category,id
     * @foreignLinks id,\App\Models\ProductImage,product_id|id,\App\Models\ProductTag,product_id
     * @mixin _IH_Product_QB
     */
    class Product extends Model {}

    /**
     * @property int $id
     * @property string $image_path
     * @property int $product_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property string $image_name
     * @method static _IH_ProductImage_QB onWriteConnection()
     * @method _IH_ProductImage_QB newQuery()
     * @method static _IH_ProductImage_QB on(null|string $connection = null)
     * @method static _IH_ProductImage_QB query()
     * @method static _IH_ProductImage_QB with(array|string $relations)
     * @method _IH_ProductImage_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_ProductImage_C|ProductImage[] all()
     * @ownLinks product_id,\App\Models\Product,id
     * @mixin _IH_ProductImage_QB
     */
    class ProductImage extends Model {}

    /**
     * @property int $id
     * @property int $product_id
     * @property int $tag_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_ProductTag_QB onWriteConnection()
     * @method _IH_ProductTag_QB newQuery()
     * @method static _IH_ProductTag_QB on(null|string $connection = null)
     * @method static _IH_ProductTag_QB query()
     * @method static _IH_ProductTag_QB with(array|string $relations)
     * @method _IH_ProductTag_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_ProductTag_C|ProductTag[] all()
     * @ownLinks product_id,\App\Models\Product,id|tag_id,\App\Models\Tag,id
     * @mixin _IH_ProductTag_QB
     */
    class ProductTag extends Model {}

    /**
     * @property int $id
     * @property string $name
     * @property string $display_name
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property _IH_Permission_C|Permission[] $permissionRoles
     * @property-read int $permission_roles_count
     * @method BelongsToMany|_IH_Permission_QB permissionRoles()
     * @method static _IH_Role_QB onWriteConnection()
     * @method _IH_Role_QB newQuery()
     * @method static _IH_Role_QB on(null|string $connection = null)
     * @method static _IH_Role_QB query()
     * @method static _IH_Role_QB with(array|string $relations)
     * @method _IH_Role_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Role_C|Role[] all()
     * @foreignLinks
     * @mixin _IH_Role_QB
     */
    class Role extends Model {}

    /**
     * @property int $id
     * @property string $config_key
     * @property string $config_value
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Carbon|null $deleted_at
     * @property string $type
     * @method static _IH_Setting_QB onWriteConnection()
     * @method _IH_Setting_QB newQuery()
     * @method static _IH_Setting_QB on(null|string $connection = null)
     * @method static _IH_Setting_QB query()
     * @method static _IH_Setting_QB with(array|string $relations)
     * @method _IH_Setting_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Setting_C|Setting[] all()
     * @mixin _IH_Setting_QB
     */
    class Setting extends Model {}

    /**
     * @property int $id
     * @property string $name
     * @property string $description
     * @property string $image_path
     * @property string $image_name
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Carbon|null $deleted_at
     * @method static _IH_Slider_QB onWriteConnection()
     * @method _IH_Slider_QB newQuery()
     * @method static _IH_Slider_QB on(null|string $connection = null)
     * @method static _IH_Slider_QB query()
     * @method static _IH_Slider_QB with(array|string $relations)
     * @method _IH_Slider_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Slider_C|Slider[] all()
     * @mixin _IH_Slider_QB
     */
    class Slider extends Model {}

    /**
     * @property int $id
     * @property string $name
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static _IH_Tag_QB onWriteConnection()
     * @method _IH_Tag_QB newQuery()
     * @method static _IH_Tag_QB on(null|string $connection = null)
     * @method static _IH_Tag_QB query()
     * @method static _IH_Tag_QB with(array|string $relations)
     * @method _IH_Tag_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_Tag_C|Tag[] all()
     * @foreignLinks id,\App\Models\ProductTag,tag_id
     * @mixin _IH_Tag_QB
     */
    class Tag extends Model {}

    /**
     * @property int $id
     * @property string $name
     * @property string $email
     * @property Carbon|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property DatabaseNotificationCollection|DatabaseNotification[] $notifications
     * @property-read int $notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB notifications()
     * @property DatabaseNotificationCollection|DatabaseNotification[] $readNotifications
     * @property-read int $read_notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB readNotifications()
     * @property _IH_Role_C|Role[] $roles
     * @property-read int $roles_count
     * @method BelongsToMany|_IH_Role_QB roles()
     * @property _IH_PersonalAccessToken_C|PersonalAccessToken[] $tokens
     * @property-read int $tokens_count
     * @method MorphToMany|_IH_PersonalAccessToken_QB tokens()
     * @property DatabaseNotificationCollection|DatabaseNotification[] $unreadNotifications
     * @property-read int $unread_notifications_count
     * @method MorphToMany|_IH_DatabaseNotification_QB unreadNotifications()
     * @method static _IH_User_QB onWriteConnection()
     * @method _IH_User_QB newQuery()
     * @method static _IH_User_QB on(null|string $connection = null)
     * @method static _IH_User_QB query()
     * @method static _IH_User_QB with(array|string $relations)
     * @method _IH_User_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_User_C|User[] all()
     * @foreignLinks id,\App\Models\Product,user_id
     * @mixin _IH_User_QB
     * @method static UserFactory factory(...$parameters)
     */
    class User extends Model {}
}
