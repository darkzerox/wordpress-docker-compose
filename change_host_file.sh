read_var() {
  if [ -z "$1" ]; then
    echo "environment variable name is required"
    return
  fi

  local ENV_FILE='.env'
  if [ ! -z "$2" ]; then
    ENV_FILE="$2"
  fi

  local VAR=$(grep ^$1= "$ENV_FILE" | xargs)
  IFS="=" read -ra VAR <<< "$VAR"
  echo ${VAR[1]}
}
DOMAIN=$(read_var DOMAIN)
# local my_other_var=$(read_var MY_VAR staging.env)
echo "127.0.0.1" $DOMAIN "#host from docker" | sudo tee -a /etc/hosts