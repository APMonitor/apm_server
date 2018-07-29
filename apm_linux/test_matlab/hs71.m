addpath('apm')
    
% Solve optimization problem
s = 'http://127.0.0.1';
a = 'test_matlab';
apm(s,a,'clear all');
apm_load(s,a,'hs71.apm');
output = apm(s,a,'solve');
disp(output);
sol = apm_sol(s,a);
z = sol.x;

disp('--- Results of the Optimization Problem ---')
disp(['x[1]: ' num2str(z.x1)])
disp(['x[2]: ' num2str(z.x2)])
disp(['x[3]: ' num2str(z.x3)])
disp(['x[4]: ' num2str(z.x4)])
