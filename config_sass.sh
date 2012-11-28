if [ -n "`command -v compass`" ]
then
	echo "compass is already installed."
    exit
else

gem install compass
gem install susy
	
sed -i 's+export PATH+\
\
export GEM_PATH=/home/$USER/ruby/gems\
export GEM_HOME=/home/$USER/ruby/gems\
PATH=$PATH:$HOME/bin:$HOME/ruby/gems/bin\
\
export PATH+' .bash_profile

fi