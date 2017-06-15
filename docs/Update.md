# Update

Below is a general set of update directions, there may be version specific directions at some point.

```bash
# Pull the latest code
sudo -u nginx git pull;

# Check out to the latest tag
sudo -u nginx git checkout $(git describe --tags $(git rev-list --tags --max-count=1));

# Install composer dependancies
sudo -u nginx composer install;

# Run DB Migrations
sudo -u nginx php artisan migrate --force;

# Cache routes
sudo -u nginx php artisan route:cache --force;
sudo -u nginx php artisan route:api --force;
```
