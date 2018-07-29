# Import APM package
try:
   from APMonitor import *
except:
   # Automatically install APMonitor
   import pip
   pip.main(['install','APMonitor'])
   from APMonitor import *
    
# Solve optimization problem
s = 'http://127.0.0.1'
a = 'test_python'
apm(s,a,'clear all')
apm_load(s,a,'hs71.apm')
output = apm(s,a,'solve')
print(output)
sol = apm_sol(s,a)

print('--- Results of the Optimization Problem ---')
print('x[1]: ' + str(sol['x[1]']))
print('x[2]: ' + str(sol['x[2]']))
print('x[3]: ' + str(sol['x[3]']))
print('x[4]: ' + str(sol['x[4]']))
