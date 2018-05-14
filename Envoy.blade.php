@setup
    $user = isset($user)? $user :'jenkins';
    $servers = [
        'staging' => $user.'@10.40.223.159'.' -o "StrictHostKeyChecking no"',
        'prod'    => $user.'@10.40.223.173'.' -o "StrictHostKeyChecking no"'
    ];
    $projectCode = 'pm_tool';
@endsetup

@servers($servers)

@macro('deploy-staging', ['on' => 'staging'])
    backupProject
    copyToTempDir
    updateProject
    copyToProjectDir
    runTasks
@endmacro

@macro('deploy-prod', ['on' => 'prod'])
    backupProject
    copyToTempDir
    updateProject
    copyToProjectDir
@endmacro

@task('backupProject')
    echo 'Backup project..'
    cd {{ $projectPathOnServer }}
    php artisan db:dump /var/www/backups_{{ $projectCode }}/db

    cd /var/www/backups_{{ $projectCode }}
    tar -czvf "$(date '+%y-%m-%d-%H-%M').tar.gz" {{ $projectPathOnServer }} > /dev/null
    echo 'Backup is done!'
@endtask

@task('copyToTempDir')
    rm -rf {{ $projectPathOnServer }}_temp

    echo 'Copy project to temp dir..'
    cp -r {{ $projectPathOnServer }} {{ $projectPathOnServer }}_temp  > /dev/null

    echo 'Copy project to temp dir is done!'
@endtask

@task('copyToProjectDir')
    echo 'Deploying project..'

    sudo chmod -Rf 777 {{ $projectPathOnServer }}_old
    rm -rf {{ $projectPathOnServer }}_old

    echo 'Moving to OLD..'
    sudo chmod -Rf 777 {{ $projectPathOnServer }}/storage {{ $projectPathOnServer }}/public
    mv -f {{ $projectPathOnServer }} {{ $projectPathOnServer }}_old > /dev/null
    echo 'Moving from temp to prod..'
    mv -f {{ $projectPathOnServer }}_temp {{ $projectPathOnServer }}
    echo 'Removing temp..'
    rm -rf {{ $projectPathOnServer }}_temp

    sudo chmod -R 777 {{ $projectPathOnServer }}/storage {{ $projectPathOnServer }}/public

    echo 'Success!'
@endtask

@task('updateProject')

    cd {{ $projectPathOnServer }}_temp

    echo 'Updating project in temp dir..'

    git fetch

    git reset --hard

    echo 'Checking out to {{ $branch }} ..'

    git checkout {{ $branch or 'master' }} -f

    git pull origin {{ $branch or 'master' }}

    composer update -v --no-interaction

    composer dump-autoload

    php artisan migrate

    npm install

    npm run dev

    echo 'Update project in temp is done!'
@endtask

@task('runTasks')
    cd {{ $projectPathOnServer }}
    echo 'Running tasks..'

    echo 'Clean up database? {{$cleanUpDatabase}}'

    if [ {{ $cleanUpDatabase }} = true ]; then
        php artisan migrate:fresh
        echo 'Getting 1S users..'
        php artisan 1s:get-users
        echo 'Getting LDAP data..'
        php artisan ldap
        echo 'Getting 1S Projects..'
        php artisan 1s:get-projects
    else
        echo 'Skipping database clean up..'
    fi

    if [ {{ $cleanUpDatabase }} = true ]; then
        echo 'Running seeds..'
        php artisan db:seed
    fi

    echo 'Finished runTasks!'

@endtask

